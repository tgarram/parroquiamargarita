<?php

declare(strict_types=1);

use Parroquia\Content\ContentItem;
use Parroquia\Content\ContentRepository;

$fixturesPath = dirname(__DIR__, 2).'/Fixtures/content';

beforeAll(function () use ($fixturesPath): void {
    $types = ['articulos', 'eventos'];

    foreach ($types as $type) {
        if (! is_dir("{$fixturesPath}/{$type}")) {
            mkdir("{$fixturesPath}/{$type}", 0755, true);
        }
    }

    file_put_contents("{$fixturesPath}/articulos/publicado.php", "<?php\nreturn ['status' => 'published', 'title_es' => 'Artículo publicado'];");
    file_put_contents("{$fixturesPath}/articulos/pendiente.php", "<?php\nreturn ['status' => 'pending', 'title_es' => 'Artículo pendiente'];");
    file_put_contents("{$fixturesPath}/articulos/borrador.php", "<?php\nreturn ['status' => 'draft', 'title_es' => 'Borrador'];");
});

afterAll(function () use ($fixturesPath): void {
    array_map('unlink', glob("{$fixturesPath}/articulos/*.php") ?: []);
    rmdir("{$fixturesPath}/articulos");
    rmdir("{$fixturesPath}/eventos");
    rmdir($fixturesPath);
});

it('returns only published items by default', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);
    $items = $repo->findAll('articulos');

    expect($items)->toHaveCount(1);
    expect($items[0]->status)->toBe('published');
    expect($items[0]->slug)->toBe('publicado');
});

it('returns all items when status is wildcard', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);
    $items = $repo->findAll('articulos', '*');

    expect($items)->toHaveCount(3);
});

it('returns pending items when filtered', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);
    $items = $repo->findAll('articulos', 'pending');

    expect($items)->toHaveCount(1);
    expect($items[0]->slug)->toBe('pendiente');
});

it('returns empty array for non-existent type', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);
    $items = $repo->findAll('inexistente');

    expect($items)->toBeEmpty();
});

it('finds a single published item by slug', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);
    $item = $repo->find('articulos', 'publicado');

    expect($item)->toBeInstanceOf(ContentItem::class);
    expect($item->slug)->toBe('publicado');
    expect($item->isPublished())->toBeTrue();
});

it('returns null for a pending item when requesting published', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);
    $item = $repo->find('articulos', 'pendiente');

    expect($item)->toBeNull();
});

it('returns null for non-existent slug', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);

    expect($repo->find('articulos', 'no-existe'))->toBeNull();
});

it('reads translated fields with fallback', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);
    $item = $repo->find('articulos', 'publicado');

    expect($item)->not->toBeNull();
    expect($item->trans('title', 'es'))->toBe('Artículo publicado');
    expect($item->trans('title', 'ca'))->toBe('Artículo publicado');
});

it('returns null for empty events directory', function () use ($fixturesPath): void {
    $repo = new ContentRepository($fixturesPath);
    $items = $repo->findAll('eventos');

    expect($items)->toBeEmpty();
});
