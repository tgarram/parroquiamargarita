<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeNoticiasRouter(): Router
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

it('noticias index returns 200', function (): void {
    $router = makeNoticiasRouter();
    $response = $router->dispatch(new Request('GET', '/es/noticias', [], [], []));

    expect($response->status)->toBe(200);
});

it('noticias index lists published articles', function (): void {
    $router = makeNoticiasRouter();
    $response = $router->dispatch(new Request('GET', '/es/noticias', [], [], []));

    expect($response->body)->toContain('bienvenida-web');
});

it('noticias index contains breadcrumb navigation', function (): void {
    $router = makeNoticiasRouter();
    $response = $router->dispatch(new Request('GET', '/es/noticias', [], [], []));

    expect($response->body)->toContain('aria-label="'.e(__('general.breadcrumb')).'"');
});

it('noticias detail returns 404 for non-existent slug', function (): void {
    $router = makeNoticiasRouter();
    $response = $router->dispatch(new Request('GET', '/es/noticias/no-existe', [], [], []));

    expect($response->status)->toBe(404);
});

it('noticias detail returns 404 for pending content', function (): void {
    $router = makeNoticiasRouter();
    $response = $router->dispatch(new Request('GET', '/es/noticias/misa-dominical', [], [], []));

    expect($response->status)->toBe(404);
});

it('nav contains noticias link', function (): void {
    $router = makeNoticiasRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('href="/es/noticias"');
});

it('noticias index renders in catalan', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeNoticiasRouter();
    $response = $router->dispatch(new Request('GET', '/ca/noticias', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('Notícies');
});
