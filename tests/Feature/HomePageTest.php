<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeHomeRouter(): Router
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

it('home page renders with 200 status', function (): void {
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->status)->toBe(200);
});

it('home page contains hero section with site name', function (): void {
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)
        ->toContain('Parroquia Castrense de Santa Margarita')
        ->toContain('id="hero-title"');
});

it('home page has landmark sections with aria-labelledby', function (): void {
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)
        ->toContain('aria-labelledby="horarios-title"')
        ->toContain('aria-labelledby="noticias-title"')
        ->toContain('aria-labelledby="contacto-title"');
});

it('home page shows pending notice when no published schedules exist', function (): void {
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain(__('general.home_schedules_pending'));
});

it('home page shows pending contact notice', function (): void {
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain(__('general.home_contact_pending'));
});

it('home page does not expose pending content items directly', function (): void {
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->not->toContain('status: pending');
});

it('home page renders correctly in catalan', function () use ($langDir): void {
    Lang::setLocale('ca');
    Lang::load($langDir);
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/ca/', [], [], []));

    expect($response->body)
        ->toContain('Parròquia Castrense de Santa Margalida')
        ->toContain('Horaris');
});

it('home page renders correctly in english', function () use ($langDir): void {
    Lang::setLocale('en');
    Lang::load($langDir);
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/en/', [], [], []));

    expect($response->body)
        ->toContain('Military Parish of Saint Margaret')
        ->toContain('Schedules');
});

it('home page has meta description tag', function (): void {
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('<meta name="description"')
        ->and($response->body)->toContain(__('general.meta_home_description'));
});

it('home page has canonical link tag', function (): void {
    $router = makeHomeRouter();
    $response = $router->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)->toContain('<link rel="canonical"')
        ->and($response->body)->toContain('/es/');
});
