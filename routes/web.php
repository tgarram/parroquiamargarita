<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Response;
use Parroquia\Http\Router;
use Parroquia\View\Renderer;

return function (Router $router, Renderer $renderer): void {

    $router->get('/', function (Request $request) use ($renderer): Response {
        return new Response(
            $renderer->renderInLayout('layouts.base', 'pages.home', [
                'title' => __('general.home_title'),
            ])
        );
    });

    $router->get('/laboratorio', function (Request $request) use ($renderer): Response {
        return new Response(
            $renderer->renderInLayout('layouts.base', 'pages.laboratorio', [
                'title' => __('general.lab_title'),
            ])
        );
    });

};
