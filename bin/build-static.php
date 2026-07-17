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
    ['/noticias', 'noticias/index.html'],
    ['/sobre', 'sobre/index.html'],
    ['/horarios', 'horarios/index.html'],
    ['/contacto', 'contacto/index.html'],
    ['/aviso-legal', 'aviso-legal/index.html'],
    ['/privacidad', 'privacidad/index.html'],
    ['/accesibilidad', 'accesibilidad/index.html'],
    ['/laboratorio', 'laboratorio/index.html'],
];

// Añadir rutas de detalle de noticias publicadas
$noticiasSlugs = array_map(
    static fn ($item) => $item->slug,
    (new ContentRepository(Config::get('content.path')))->findAll('noticias', 'published')
);

$routes = [];

foreach (['es', 'ca', 'en'] as $loc) {
    foreach ($baseRoutes as [$path, $output]) {
        $routes[] = [$loc, $path, $loc.'/'.$output];
    }

    foreach ($noticiasSlugs as $slug) {
        $routes[] = [$loc, '/noticias/'.$slug, $loc.'/noticias/'.$slug.'/index.html'];
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
$sitemapPaths = ['/', '/noticias', '/horarios', '/contacto'];

foreach ($noticiasSlugs as $slug) {
    $sitemapPaths[] = '/noticias/'.$slug;
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
