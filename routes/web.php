<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Response;
use Parroquia\Http\Router;
use Parroquia\View\Renderer;

return function (Router $router, Renderer $renderer): void {

    // Root → default locale
    $router->get('/', fn (Request $r) => Response::redirect(base_path('/es/')));

    foreach (['es', 'ca', 'en'] as $locale) {
        $router->group('/'.$locale, function (Router $r) use ($renderer, $locale): void {

            $r->get('/', fn (Request $req) => new Response(
                $renderer->renderInLayout('layouts.base', 'pages.home', [
                    'title' => __('general.home_title'),
                    'locale' => $locale,
                    'path' => '/',
                ])
            ));

            $r->get('/laboratorio', fn (Request $req) => new Response(
                $renderer->renderInLayout('layouts.base', 'pages.laboratorio', [
                    'title' => __('general.lab_title'),
                    'locale' => $locale,
                    'path' => '/laboratorio',
                ])
            ));
        });
    }

};
