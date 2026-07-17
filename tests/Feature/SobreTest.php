<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeSobreRouter(): Router
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

it('sobre page returns 200', function (): void {
    $router = makeSobreRouter();
    $response = $router->dispatch(new Request('GET', '/es/sobre', [], [], []));

    expect($response->status)->toBe(200);
});

it('sobre page shows pending notice when content is pending', function (): void {
    $router = makeSobreRouter();
    $response = $router->dispatch(new Request('GET', '/es/sobre', [], [], []));

    expect($response->body)->toContain(__('general.about_pending'));
});

it('sobre page contains breadcrumb navigation', function (): void {
    $router = makeSobreRouter();
    $response = $router->dispatch(new Request('GET', '/es/sobre', [], [], []));

    expect($response->body)->toContain('aria-label="'.e(__('general.breadcrumb')).'"');
});

it('nav contains sobre link', function (): void {
    $router = makeSobreRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('href="/es/sobre"');
});

it('sobre page renders in catalan', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeSobreRouter();
    $response = $router->dispatch(new Request('GET', '/ca/sobre', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('Sobre la Parr');
});

it('sobre page renders in english', function () use ($langDir): void {
    Lang::setLocale('en');
    Lang::load($langDir);
    $router = makeSobreRouter();
    $response = $router->dispatch(new Request('GET', '/en/sobre', [], [], []));

    expect($response->status)->toBe(200);
    expect($response->body)->toContain('About the Parish');
});
