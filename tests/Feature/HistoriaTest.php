<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeHistoriaRouter(): Router
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

it('historia page returns 200', function (): void {
    $router = makeHistoriaRouter();
    $response = $router->dispatch(new Request('GET', '/es/historia', [], [], []));

    expect($response->status)->toBe(200);
});

it('historia page shows pending notice when content not published', function (): void {
    $router = makeHistoriaRouter();
    $response = $router->dispatch(new Request('GET', '/es/historia', [], [], []));

    expect($response->body)->toContain('preparación');
});

it('historia page contains breadcrumb', function (): void {
    $router = makeHistoriaRouter();
    $response = $router->dispatch(new Request('GET', '/es/historia', [], [], []));

    expect($response->body)->toContain('aria-label="'.e(__('general.breadcrumb')).'"');
});

it('historia page contains section heading', function (): void {
    $router = makeHistoriaRouter();
    $response = $router->dispatch(new Request('GET', '/es/historia', [], [], []));

    expect($response->body)->toContain('Historia y Patrimonio');
});

it('historia page has CTA to visita', function (): void {
    $router = makeHistoriaRouter();
    $response = $router->dispatch(new Request('GET', '/es/historia', [], [], []));

    expect($response->body)->toContain('/es/visita');
});

it('historia page renders in catalan', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeHistoriaRouter();
    $response = $router->dispatch(new Request('GET', '/ca/historia', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('Història i Patrimoni');
});

it('historia page renders in english', function () use ($langDir): void {
    Lang::setLocale('en');
    Lang::load($langDir);
    $router = makeHistoriaRouter();
    $response = $router->dispatch(new Request('GET', '/en/historia', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('History and Heritage');
});

it('nav contains historia link', function (): void {
    $router = makeHistoriaRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('href="/es/historia"');
});
