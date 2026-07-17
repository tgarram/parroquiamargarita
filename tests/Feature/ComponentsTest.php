<?php

declare(strict_types=1);

use Parroquia\View\Renderer;

beforeEach(function (): void {
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    Renderer::register($renderer);
});

it('renders button with primary variant', function (): void {
    $html = component('ui.button', ['label' => 'Aceptar', 'variant' => 'primary']);

    expect($html)
        ->toContain('Aceptar')
        ->toContain('bg-[--color-navy]')
        ->toContain('<button');
});

it('renders button as anchor when tag is a', function (): void {
    $html = component('ui.button', ['label' => 'Ver más', 'tag' => 'a', 'href' => '/info']);

    expect($html)
        ->toContain('<a')
        ->toContain('href="/info"');
});

it('renders button with disabled state', function (): void {
    $html = component('ui.button', ['label' => 'Enviar', 'disabled' => true]);

    expect($html)->toContain('disabled');
});

it('renders card with slot content', function (): void {
    $html = component('ui.card', ['slot' => '<p>Contenido de prueba</p>', 'variant' => 'bordered']);

    expect($html)
        ->toContain('Contenido de prueba')
        ->toContain('border');
});

it('renders section-header with eyebrow and subtitle', function (): void {
    $html = component('ui.section-header', [
        'eyebrow' => 'Historia',
        'title' => 'La parroquia',
        'subtitle' => 'Un texto descriptivo',
    ]);

    expect($html)
        ->toContain('Historia')
        ->toContain('La parroquia')
        ->toContain('Un texto descriptivo');
});

it('renders breadcrumbs with correct current page', function (): void {
    $html = component('ui.breadcrumbs', ['items' => [
        ['label' => 'Inicio', 'href' => '/'],
        ['label' => 'Noticias'],
    ]]);

    expect($html)
        ->toContain('aria-current="page"')
        ->toContain('Noticias')
        ->toContain('href="/"');
});

it('renders accordion with items and aria attributes', function (): void {
    $html = component('ui.accordion', [
        'id' => 'test-acc',
        'items' => [
            ['title' => 'Pregunta 1', 'content' => 'Respuesta 1'],
            ['title' => 'Pregunta 2', 'content' => 'Respuesta 2'],
        ],
    ]);

    expect($html)
        ->toContain('Pregunta 1')
        ->toContain('aria-expanded')
        ->toContain('aria-controls');
});

it('renders notice-banner with correct role for error variant', function (): void {
    $html = component('ui.notice-banner', ['variant' => 'error', 'message' => 'Error crítico']);

    expect($html)
        ->toContain('role="alert"')
        ->toContain('Error crítico');
});

it('renders notice-banner with dismissible button when enabled', function (): void {
    $html = component('ui.notice-banner', [
        'variant' => 'info',
        'message' => 'Aviso',
        'dismissible' => true,
    ]);

    expect($html)->toContain('@click="show = false"');
});

it('renders form-field with label and error', function (): void {
    $html = component('ui.form-field', [
        'name' => 'email',
        'label' => 'Correo',
        'type' => 'email',
        'error' => 'Formato inválido',
    ]);

    expect($html)
        ->toContain('<label')
        ->toContain('Correo')
        ->toContain('role="alert"')
        ->toContain('Formato inválido');
});

it('renders form-field textarea with correct rows', function (): void {
    $html = component('ui.form-field', [
        'name' => 'mensaje',
        'type' => 'textarea',
        'rows' => 6,
    ]);

    expect($html)
        ->toContain('<textarea')
        ->toContain('rows="6"');
});

it('renders footer with copyright year', function (): void {
    $html = component('ui.footer', ['year' => 2025]);

    expect($html)
        ->toContain('2025')
        ->toContain('<footer');
});

it('renders skip-link targeting main by default', function (): void {
    $html = component('ui.skip-link');

    expect($html)->toContain('href="#main"');
});
