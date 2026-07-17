<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeHorariosRouter(): Router
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

it('horarios page returns 200', function (): void {
    $router = makeHorariosRouter();
    $response = $router->dispatch(new Request('GET', '/es/horarios', [], [], []));

    expect($response->status)->toBe(200);
});

it('horarios page shows pending notice when no published schedules', function (): void {
    $router = makeHorariosRouter();
    $response = $router->dispatch(new Request('GET', '/es/horarios', [], [], []));

    expect($response->body)->toContain(__('general.schedules_pending'));
});

it('horarios page contains breadcrumb navigation', function (): void {
    $router = makeHorariosRouter();
    $response = $router->dispatch(new Request('GET', '/es/horarios', [], [], []));

    expect($response->body)->toContain('aria-label="'.e(__('general.breadcrumb')).'"');
});

it('nav contains horarios link', function (): void {
    $router = makeHorariosRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('href="/es/horarios"');
});

it('horarios page renders in catalan', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeHorariosRouter();
    $response = $router->dispatch(new Request('GET', '/ca/horarios', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('Horaris');
});
