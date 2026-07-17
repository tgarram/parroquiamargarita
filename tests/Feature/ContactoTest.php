<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeContactoRouter(): Router
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

it('contacto page returns 200', function (): void {
    $router = makeContactoRouter();
    $response = $router->dispatch(new Request('GET', '/es/contacto', [], [], []));

    expect($response->status)->toBe(200);
});

it('contacto page shows pending notice when content is pending', function (): void {
    $router = makeContactoRouter();
    $response = $router->dispatch(new Request('GET', '/es/contacto', [], [], []));

    expect($response->body)->toContain(__('general.contact_pending'));
});

it('contacto page contains breadcrumb navigation', function (): void {
    $router = makeContactoRouter();
    $response = $router->dispatch(new Request('GET', '/es/contacto', [], [], []));

    expect($response->body)->toContain('aria-label="'.e(__('general.breadcrumb')).'"');
});

it('nav contains contacto link', function (): void {
    $router = makeContactoRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('href="/es/contacto"');
});

it('contacto page renders in catalan', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeContactoRouter();
    $response = $router->dispatch(new Request('GET', '/ca/contacto', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('Contacte');
});
