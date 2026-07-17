<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeVisitaRouter(): Router
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

it('visita page returns 200', function (): void {
    $router = makeVisitaRouter();
    $response = $router->dispatch(new Request('GET', '/es/visita', [], [], []));

    expect($response->status)->toBe(200);
});

it('visita page shows pending notice when content not published', function (): void {
    $router = makeVisitaRouter();
    $response = $router->dispatch(new Request('GET', '/es/visita', [], [], []));

    expect($response->body)->toContain('pendiente de confirmación');
});

it('visita page contains section heading', function (): void {
    $router = makeVisitaRouter();
    $response = $router->dispatch(new Request('GET', '/es/visita', [], [], []));

    expect($response->body)->toContain('Visita la Parroquia');
});

it('visita page has link to contacto', function (): void {
    $router = makeVisitaRouter();
    $response = $router->dispatch(new Request('GET', '/es/visita', [], [], []));

    expect($response->body)->toContain('/es/contacto');
});

it('visita page contains breadcrumb', function (): void {
    $router = makeVisitaRouter();
    $response = $router->dispatch(new Request('GET', '/es/visita', [], [], []));

    expect($response->body)->toContain('aria-label="'.e(__('general.breadcrumb')).'"');
});

it('visita page renders in catalan', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeVisitaRouter();
    $response = $router->dispatch(new Request('GET', '/ca/visita', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('Visita la Parròquia');
});

it('visita page renders in english', function () use ($langDir): void {
    Lang::setLocale('en');
    Lang::load($langDir);
    $router = makeVisitaRouter();
    $response = $router->dispatch(new Request('GET', '/en/visita', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('Visit the Parish');
});

it('nav contains visita link', function (): void {
    $router = makeVisitaRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('href="/es/visita"');
});
