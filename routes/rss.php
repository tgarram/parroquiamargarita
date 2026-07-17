<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Response;
use Parroquia\Http\Router;

return function (Router $router): void {

    $router->get('/feed.xml', function (Request $req): Response {
        $locale = 'es';
        $appUrl = rtrim((string) config('app.url', ''), '/');
        $appName = config('app.name', '');
        $noticias = content()->findAll('noticias', 'published');

        $items = '';
        foreach ($noticias as $noticia) {
            $title = e($noticia->trans('title', $locale) ?? '');
            $link = $appUrl.'/'.$locale.'/noticias/'.$noticia->slug;
            $desc = e($noticia->trans('excerpt', $locale) ?? '');
            $items .= "    <item>\n";
            $items .= "      <title>{$title}</title>\n";
            $items .= "      <link>{$link}</link>\n";
            $items .= "      <guid>{$link}</guid>\n";
            $items .= "      <description>{$desc}</description>\n";
            $items .= "    </item>\n";
        }

        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>{$appName}</title>
    <link>{$appUrl}/es/</link>
    <description>Noticias de {$appName}</description>
    <language>es</language>
    <atom:link href="{$appUrl}/feed.xml" rel="self" type="application/rss+xml"/>
{$items}  </channel>
</rss>
XML;

        return new Response($xml, 200, ['Content-Type' => 'application/rss+xml; charset=utf-8']);
    });

};
