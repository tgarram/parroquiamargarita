<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Response;
use Parroquia\Http\Router;

it('dispatches a registered GET route', function (): void {
    $router = new Router;
    $router->get('/', fn (Request $r): Response => new Response('home'));

    $request = new Request('GET', '/', [], [], []);
    $response = $router->dispatch($request);

    expect($response)->toBeInstanceOf(Response::class);
});

it('returns 404 for unknown routes', function (): void {
    $router = new Router;
    $request = new Request('GET', '/unknown', [], [], []);

    $response = $router->dispatch($request);

    expect($response)->toBeInstanceOf(Response::class);
});

it('extracts named path parameters', function (): void {
    $router = new Router;
    $captured = null;

    $router->get('/noticias/{slug}', function (Request $r, string $slug) use (&$captured): Response {
        $captured = $slug;

        return new Response('ok');
    });

    $request = new Request('GET', '/noticias/misa-dominical', [], [], []);
    $router->dispatch($request);

    expect($captured)->toBe('misa-dominical');
});
