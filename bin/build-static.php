<?php

declare(strict_types=1);

/**
 * Static site generator.
 *
 * Usage:
 *   APP_BASE_PATH=/parroquiamargarita php bin/build-static.php
 *
 * Boots the application, renders each known route to HTML, and writes
 * the output to dist/ alongside the compiled assets.
 */

require dirname(__DIR__).'/vendor/autoload.php';

use Parroquia\Content\ContentRepository;
use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Config;
use Parroquia\Support\Env;
use Parroquia\Support\Lang;
use Parroquia\Support\Vite;
use Parroquia\View\Renderer;

Env::load(dirname(__DIR__));
Config::load(dirname(__DIR__).'/config');
Vite::load((string) Config::get('vite.manifest'));

$renderer = new Renderer(dirname(__DIR__).'/views');
Renderer::register($renderer);

$distDir = dirname(__DIR__).'/dist';

// ---------------------------------------------------------------------------
// Routes to render: [locale, path, output file]
// ---------------------------------------------------------------------------
$baseRoutes = [
    ['/', 'index.html'],
    ['/historia', 'historia/index.html'],
    ['/servicios', 'servicios/index.html'],
    ['/noticias', 'noticias/index.html'],
    ['/sobre', 'sobre/index.html'],
    ['/horarios', 'horarios/index.html'],
    ['/visita', 'visita/index.html'],
    ['/contacto', 'contacto/index.html'],
    ['/aviso-legal', 'aviso-legal/index.html'],
    ['/privacidad', 'privacidad/index.html'],
    ['/accesibilidad', 'accesibilidad/index.html'],
    ['/laboratorio', 'laboratorio/index.html'],
];

$contentRepo = new ContentRepository(Config::get('content.path'));

// Añadir rutas de detalle de noticias publicadas
$noticiasSlugs = array_map(
    static fn ($item) => $item->slug,
    $contentRepo->findAll('noticias', 'published')
);

// Añadir rutas de detalle de servicios (todos los estados para pre-render)
$serviciosSlugs = array_map(
    static fn ($item) => $item->slug,
    $contentRepo->findAll('servicios', '*')
);

$routes = [];

foreach (['es', 'ca', 'en'] as $loc) {
    foreach ($baseRoutes as [$path, $output]) {
        $routes[] = [$loc, $path, $loc.'/'.$output];
    }

    foreach ($noticiasSlugs as $slug) {
        $routes[] = [$loc, '/noticias/'.$slug, $loc.'/noticias/'.$slug.'/index.html'];
    }

    foreach ($serviciosSlugs as $slug) {
        $routes[] = [$loc, '/servicios/'.$slug, $loc.'/servicios/'.$slug.'/index.html'];
    }
}

// ---------------------------------------------------------------------------
// Render
// ---------------------------------------------------------------------------
foreach ($routes as [$locale, $path, $output]) {
    Lang::setLocale($locale);
    Lang::load(dirname(__DIR__).'/lang');

    $router = new Router;
    $register = require dirname(__DIR__).'/routes/web.php';
    $register($router, $renderer);

    $request = new Request('GET', '/'.$locale.$path, [], [], []);
    $response = $router->dispatch($request);

    if ($response->status !== 200) {
        echo "  SKIP  /{$locale}{$path} (status {$response->status})\n";

        continue;
    }

    $file = $distDir.'/'.$output;
    $dir = dirname($file);

    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    file_put_contents($file, $response->body);
    echo "  OK    /{$locale}{$path} → dist/{$output}\n";
}

// ---------------------------------------------------------------------------
// Root redirect index
// ---------------------------------------------------------------------------
$basePath = rtrim((string) Config::get('app.base_path', ''), '/');
$redirect = $basePath.'/es/';
$html = <<<HTML
<!doctype html>
<html><head><meta charset="utf-8">
<meta http-equiv="refresh" content="0;url={$redirect}">
<link rel="canonical" href="{$redirect}">
</head><body></body></html>
HTML;

file_put_contents($distDir.'/index.html', $html);
echo "  OK    / → dist/index.html (redirect)\n";

// ---------------------------------------------------------------------------
// sitemap.xml
// ---------------------------------------------------------------------------
$sitemapUrl = rtrim((string) Config::get('app.url', ''), '/');
$sitemapLocales = ['es', 'ca', 'en'];
$sitemapPaths = ['/', '/historia', '/servicios', '/noticias', '/horarios', '/visita', '/contacto', '/sobre', '/aviso-legal', '/privacidad', '/accesibilidad'];

foreach ($noticiasSlugs as $slug) {
    $sitemapPaths[] = '/noticias/'.$slug;
}

foreach ($serviciosSlugs as $slug) {
    $sitemapPaths[] = '/servicios/'.$slug;
}

$xmlUrls = '';
foreach ($sitemapPaths as $sitemapPath) {
    // Primary URL (es)
    $loc = $sitemapUrl.'/es'.$sitemapPath;
    $xmlUrls .= "  <url>\n    <loc>".htmlspecialchars($loc, ENT_XML1)."</loc>\n";
    foreach ($sitemapLocales as $loc2) {
        $xmlUrls .= '    <xhtml:link rel="alternate" hreflang="'.htmlspecialchars($loc2, ENT_XML1).'" href="'.htmlspecialchars($sitemapUrl.'/'.$loc2.$sitemapPath, ENT_XML1).'"/>'."\n";
    }
    $xmlUrls .= "    <changefreq>weekly</changefreq>\n  </url>\n";
}

$sitemap = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
{$xmlUrls}</urlset>
XML;

file_put_contents($distDir.'/sitemap.xml', $sitemap);
echo "  OK    sitemap.xml\n";

// ---------------------------------------------------------------------------
// RSS feed
// ---------------------------------------------------------------------------
$rssUrl = rtrim((string) Config::get('app.url', ''), '/');
$rssName = Config::get('app.name', '');
$rssItems = '';

Lang::setLocale('es');
Lang::load(dirname(__DIR__).'/lang');

foreach ((new ContentRepository(Config::get('content.path')))->findAll('noticias', 'published') as $noticia) {
    $title = htmlspecialchars($noticia->trans('title', 'es') ?? '', ENT_XML1 | ENT_QUOTES, 'UTF-8');
    $link = $rssUrl.'/es/noticias/'.$noticia->slug;
    $desc = htmlspecialchars($noticia->trans('excerpt', 'es') ?? '', ENT_XML1 | ENT_QUOTES, 'UTF-8');
    $rssItems .= "    <item>\n";
    $rssItems .= "      <title>{$title}</title>\n";
    $rssItems .= "      <link>{$link}</link>\n";
    $rssItems .= "      <guid>{$link}</guid>\n";
    $rssItems .= "      <description>{$desc}</description>\n";
    $rssItems .= "    </item>\n";
}

$rssSiteName = htmlspecialchars($rssName, ENT_XML1 | ENT_QUOTES, 'UTF-8');
$rssXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>{$rssSiteName}</title>
    <link>{$rssUrl}/es/</link>
    <description>Noticias de {$rssSiteName}</description>
    <language>es</language>
    <atom:link href="{$rssUrl}/feed.xml" rel="self" type="application/rss+xml"/>
{$rssItems}  </channel>
</rss>
XML;

file_put_contents($distDir.'/feed.xml', $rssXml);
echo "  OK    feed.xml\n";

// Copy robots.txt
$robotsSrc = dirname(__DIR__).'/public/robots.txt';
if (file_exists($robotsSrc)) {
    copy($robotsSrc, $distDir.'/robots.txt');
    echo "  OK    robots.txt\n";
}

// ---------------------------------------------------------------------------
// .nojekyll (needed for assets with _ or . prefixes on GitHub Pages)
// ---------------------------------------------------------------------------
file_put_contents($distDir.'/.nojekyll', '');

// ---------------------------------------------------------------------------
// Copy compiled assets
// ---------------------------------------------------------------------------
$buildSrc = dirname(__DIR__).'/public/build';
$buildDst = $distDir.'/build';

if (is_dir($buildSrc)) {
    copyDir($buildSrc, $buildDst);
    echo "  OK    public/build → dist/build\n";
} else {
    echo "  WARN  public/build not found — run `npm run build` first\n";
}

echo "\nDone. Static site in dist/\n";

// ---------------------------------------------------------------------------

function copyDir(string $src, string $dst): void
{
    if (! is_dir($dst)) {
        mkdir($dst, 0755, true);
    }

    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($src, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
    );

    foreach ($items as $item) {
        $target = $dst.'/'.substr($item->getPathname(), strlen($src) + 1);

        if ($item->isDir()) {
            if (! is_dir($target)) {
                mkdir($target, 0755, true);
            }
        } else {
            copy($item->getPathname(), $target);
        }
    }
}
