<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeHeaderRouter(): Router
{
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    Renderer::register($renderer);
    $router = new Router;
    $register = require dirname(__DIR__, 2).'/routes/web.php';
    $register($router, $renderer);

    return $router;
}

$langDir = dirname(__DIR__, 2).'/lang';

it('home page contains the site name in the header', function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('Parroquia Castrense de Santa Margarita');
});

it('home page contains main navigation landmark', function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('aria-label="Navegación principal"');
});

it('home page navigation link has aria-current page on active route', function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('aria-current="page"');
});

it('header contains hamburger button for mobile', function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)
        ->toContain('@click="open = !open"')
        ->toContain(':aria-expanded');
});

it('header renders in catalan with translated labels', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/ca/', [], [], []));

    expect($response->body)
        ->toContain('Parròquia Castrense de Santa Margalida')
        ->toContain('Inici');
});

it('header hamburger button has aria-controls targeting mobile-menu', function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)
        ->toContain('aria-controls="mobile-menu"')
        ->toContain('id="mobile-menu"');
});

it('logo link has descriptive aria-label', function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('aria-label=');
});

it('lang-switcher links have full language name as aria-label', function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)
        ->toContain('aria-label="Català"')
        ->toContain('aria-label="English"');
});

it('lang-switcher nav has translated aria-label', function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
    $router = makeHeaderRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('Selector de idioma');
});
