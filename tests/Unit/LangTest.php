<?php

declare(strict_types=1);

use Parroquia\Support\Lang;

it('translates a known key', function (): void {
    expect(__('general.skip_to_content'))->toBe('Saltar al contenido');
});

it('returns the key when translation is missing', function (): void {
    expect(__('general.clave_inexistente'))->toBe('general.clave_inexistente');
});

it('replaces placeholders', function (): void {
    Lang::setLocale('es');

    expect(Lang::trans('general.home_title'))->toBe('Inicio');
});
