<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Router;
use Parroquia\Support\Lang;
use Parroquia\View\Renderer;

function makeRssRouter(): Router
{
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    Renderer::register($renderer);
    $router = new Router;
    $register = require dirname(__DIR__, 2).'/routes/web.php';
    $register($router, $renderer);
    $registerRss = require dirname(__DIR__, 2).'/routes/rss.php';
    $registerRss($router);

    return $router;
}

$langDir = dirname(__DIR__, 2).'/lang';

beforeEach(function () use ($langDir): void {
    Lang::setLocale('es');
    Lang::load($langDir);
});

it('feed.xml returns 200', function (): void {
    $router = makeRssRouter();
    $response = $router->dispatch(new Request('GET', '/feed.xml', [], [], []));

    expect($response->status)->toBe(200);
});

it('feed.xml body starts with xml declaration', function (): void {
    $router = makeRssRouter();
    $response = $router->dispatch(new Request('GET', '/feed.xml', [], [], []));

    expect($response->body)->toStartWith('<?xml');
});

it('feed.xml contains rss root element', function (): void {
    $router = makeRssRouter();
    $response = $router->dispatch(new Request('GET', '/feed.xml', [], [], []));

    expect($response->body)
        ->toContain('<rss')
        ->toContain('</rss>');
});

it('feed.xml contains channel element', function (): void {
    $router = makeRssRouter();
    $response = $router->dispatch(new Request('GET', '/feed.xml', [], [], []));

    expect($response->body)
        ->toContain('<channel>')
        ->toContain('</channel>');
});

it('feed.xml contains atom self link', function (): void {
    $router = makeRssRouter();
    $response = $router->dispatch(new Request('GET', '/feed.xml', [], [], []));

    expect($response->body)->toContain('rel="self"');
});

it('feed.xml is valid xml', function (): void {
    $router = makeRssRouter();
    $response = $router->dispatch(new Request('GET', '/feed.xml', [], [], []));

    $doc = new DOMDocument;
    $loaded = @$doc->loadXML($response->body);

    expect($loaded)->toBeTrue();
});
