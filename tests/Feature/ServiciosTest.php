<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeServiciosRouter(): Router
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

it('servicios index returns 200', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/servicios', [], [], []));

    expect($response->status)->toBe(200);
});

it('servicios index contains section heading', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/servicios', [], [], []));

    expect($response->body)->toContain('Servicios Pastorales');
});

it('servicios index shows service cards', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/servicios', [], [], []));

    expect($response->body)->toContain('Bautismo');
    expect($response->body)->toContain('Matrimonio');
});

it('servicios index contains breadcrumb', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/servicios', [], [], []));

    expect($response->body)->toContain('aria-label="'.e(__('general.breadcrumb')).'"');
});

it('servicio bautismo show returns 200', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/servicios/bautismo', [], [], []));

    expect($response->status)->toBe(200);
});

it('servicio show contains service title', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/servicios/bautismo', [], [], []));

    expect($response->body)->toContain('Bautismo');
});

it('servicio show has CTA to contact', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/servicios/bautismo', [], [], []));

    expect($response->body)->toContain('/es/contacto');
});

it('servicio show returns 404 for unknown slug', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/servicios/inexistente', [], [], []));

    expect($response->status)->toBe(404);
});

it('servicios renders in catalan', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/ca/servicios', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('Serveis Pastorals');
});

it('nav contains servicios link', function (): void {
    $router = makeServiciosRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('href="/es/servicios"');
});
