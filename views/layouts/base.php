<!doctype html>
<html lang="<?= e($locale ?? config('app.locale', 'es')) ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= e($description ?? '') ?>">
    <title><?= isset($title) ? e($title).' · ' : '' ?><?= e(config('app.name', '')) ?></title>

    <?php
    $currentLocale = $locale ?? config('app.locale', 'es');
$currentPath = $path ?? '/';
foreach (['es', 'ca', 'en'] as $loc) {
    ?>
    <link rel="alternate" hreflang="<?= e($loc) ?>" href="<?= e(config('app.url', '').'/'.e($loc).e($currentPath)) ?>">
    <?php } ?>
    <link rel="alternate" hreflang="x-default" href="<?= e(config('app.url', '').'/es'.e($currentPath)) ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <?= vite('resources/js/app.js') ?>
</head>
<body x-data>
    <?= component('ui.skip-link') ?>

    <header class="border-b border-[var(--color-border)] bg-[var(--color-background)]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="/<?= e($currentLocale) ?>/" class="font-serif text-sm font-semibold tracking-wide text-[var(--color-navy)]">
                <?= e(__('general.site_name')) ?>
            </a>
            <?= component('ui.lang-switcher', ['current' => $currentLocale, 'path' => $currentPath]) ?>
        </div>
    </header>

    <?= $content ?? '' ?>

    <?= component('ui.footer') ?>
</body>
</html>
