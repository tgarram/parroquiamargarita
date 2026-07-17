<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeErrorRouter(): Router
{
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    Renderer::register($renderer);
    $router = new Router;
    $register = require dirname(__DIR__, 2).'/routes/web.php';
    $register($router, $renderer);

    return $router;
}

$langDir = dirname(__DIR__, 2).'/lang';

beforeEach(function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
});

it('unknown route returns 404 status', function (): void {
    $router = makeErrorRouter();
    $response = $router->dispatch(new Request('GET', '/es/ruta-inexistente', [], [], []));

    expect($response->status)->toBe(404);
});

it('404 page view renders page_not_found key', function (): void {
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    Renderer::register($renderer);

    $html = $renderer->renderInLayout('layouts.base', 'errors.404', [
        'title' => __('general.page_not_found'),
        'locale' => 'es',
        'path' => '/ruta-inexistente',
    ]);

    expect($html)
        ->toContain(__('general.page_not_found'))
        ->toContain(__('general.page_not_found_desc'));
});

it('404 page contains a link back to home', function (): void {
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    Renderer::register($renderer);

    $html = $renderer->renderInLayout('layouts.base', 'errors.404', [
        'title' => __('general.page_not_found'),
        'locale' => 'es',
        'path' => '/ruta-inexistente',
    ]);

    expect($html)->toContain('href=');
});
