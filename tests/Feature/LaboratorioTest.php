<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeLaboratorioRouter(): Router
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

it('laboratorio page returns 200', function (): void {
    $router = makeLaboratorioRouter();
    $response = $router->dispatch(new Request('GET', '/es/laboratorio', [], [], []));

    expect($response->status)->toBe(200);
});

it('laboratorio page contains lab title', function (): void {
    $router = makeLaboratorioRouter();
    $response = $router->dispatch(new Request('GET', '/es/laboratorio', [], [], []));

    expect($response->body)->toContain(__('general.lab_title'));
});

it('laboratorio page renders in catalan', function (): void {
    Lang::setLocale('ca');
    Lang::load(dirname(__DIR__, 2).'/lang');
    $router = makeLaboratorioRouter();
    $response = $router->dispatch(new Request('GET', '/ca/laboratorio', [], [], []));

    expect($response->status)->toBe(200);
});
