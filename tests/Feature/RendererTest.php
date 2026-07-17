<?php

declare(strict_types=1);

use Parroquia\View\Renderer;

it('renders a view with injected variables', function (): void {
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    $html = $renderer->render('pages.home', []);

    expect($html)->toContain('Santa Margarita');
});

it('throws when view does not exist', function (): void {
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');

    expect(fn () => $renderer->render('pages.inexistente'))
        ->toThrow(RuntimeException::class);
});

it('renders laboratorio page with design tokens sections', function (): void {
    $renderer = new Renderer(dirname(__DIR__, 2).'/views');
    Renderer::register($renderer);
    $html = $renderer->render('pages.laboratorio', []);

    expect($html)
        ->toContain('Laboratorio de diseño')
        ->toContain('Tipografía')
        ->toContain('Paleta de colores')
        ->toContain('12.1:1')
        ->toContain('Norma AA');
});
