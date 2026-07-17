<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeRequest(string $path, string $method = 'GET'): Request
{
    return new Request($method, $path, [], [], []);
}

function makeRouter(): Router
{
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    Renderer::register($renderer);
    $router = new Router;
    $register = require dirname(__DIR__, 2).'/routes/web.php';
    $register($router, $renderer);

    return $router;
}

it('redirects / to /es/', function (): void {
    $router = makeRouter();
    $response = $router->dispatch(makeRequest('/'));

    expect($response->status)->toBe(302);
});

it('returns 200 for /es/', function (): void {
    Lang::setLocale('es');
    $router = makeRouter();
    $response = $router->dispatch(makeRequest('/es/'));

    expect($response->status)->toBe(200);
});

it('returns 200 for /ca/', function (): void {
    Lang::setLocale('ca');
    $router = makeRouter();
    $response = $router->dispatch(makeRequest('/ca/'));

    expect($response->status)->toBe(200);
});

it('returns 200 for /en/', function (): void {
    Lang::setLocale('en');
    $router = makeRouter();
    $response = $router->dispatch(makeRequest('/en/'));

    expect($response->status)->toBe(200);
});

it('returns 404 for unknown locale prefix', function (): void {
    $router = makeRouter();
    $response = $router->dispatch(makeRequest('/fr/'));

    expect($response->status)->toBe(404);
});

it('serves laboratorio under each locale', function (): void {
    foreach (['es', 'ca', 'en'] as $locale) {
        Lang::setLocale($locale);
        $router = makeRouter();
        $response = $router->dispatch(makeRequest('/'.$locale.'/laboratorio'));
        expect($response->status)->toBe(200);
    }
});

it('home page contains hreflang alternate tags', function (): void {
    Lang::setLocale('es');
    $router = makeRouter();
    $response = $router->dispatch(makeRequest('/es/'));

    expect($response->body)
        ->toContain('hreflang="es"')
        ->toContain('hreflang="ca"')
        ->toContain('hreflang="en"')
        ->toContain('hreflang="x-default"');
});

it('home page contains lang-switcher links', function (): void {
    Lang::setLocale('es');
    $router = makeRouter();
    $response = $router->dispatch(makeRequest('/es/'));

    expect($response->body)
        ->toContain('href="/ca/"')
        ->toContain('href="/en/"');
});
