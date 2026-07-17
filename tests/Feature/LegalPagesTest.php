<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeLegalRouter(): Router
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

it('aviso-legal returns 200', function (): void {
    $response = makeLegalRouter()->dispatch(new Request('GET', '/es/aviso-legal', [], [], []));
    expect($response->status)->toBe(200);
});

it('aviso-legal shows pending notice', function (): void {
    $response = makeLegalRouter()->dispatch(new Request('GET', '/es/aviso-legal', [], [], []));
    expect($response->body)->toContain(__('general.legal_pending'));
});

it('privacidad returns 200', function (): void {
    $response = makeLegalRouter()->dispatch(new Request('GET', '/es/privacidad', [], [], []));
    expect($response->status)->toBe(200);
});

it('privacidad shows pending notice', function (): void {
    $response = makeLegalRouter()->dispatch(new Request('GET', '/es/privacidad', [], [], []));
    expect($response->body)->toContain(__('general.privacy_pending'));
});

it('accesibilidad returns 200', function (): void {
    $response = makeLegalRouter()->dispatch(new Request('GET', '/es/accesibilidad', [], [], []));
    expect($response->status)->toBe(200);
});

it('accesibilidad shows pending notice', function (): void {
    $response = makeLegalRouter()->dispatch(new Request('GET', '/es/accesibilidad', [], [], []));
    expect($response->body)->toContain(__('general.accessibility_pending'));
});

it('footer links to legal pages', function (): void {
    $response = makeLegalRouter()->dispatch(new Request('GET', '/es/', [], [], []));

    expect($response->body)
        ->toContain('href="/es/aviso-legal"')
        ->toContain('href="/es/privacidad"')
        ->toContain('href="/es/accesibilidad"');
});

it('legal pages contain breadcrumb', function (): void {
    $response = makeLegalRouter()->dispatch(new Request('GET', '/es/aviso-legal', [], [], []));
    expect($response->body)->toContain('aria-label="'.e(__('general.breadcrumb')).'"');
});
