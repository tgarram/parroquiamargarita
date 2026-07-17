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
    echo '<link rel="alternate" hreflang="'.e($loc).'" href="'.e(config('app.url', '').'/'.$loc.$currentPath).'">'."\n    ";
}
?>
    <link rel="alternate" hreflang="x-default" href="<?= e(config('app.url', '').'/es'.$currentPath) ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <?= vite('resources/js/app.js') ?>
</head>
<body x-data>
    <?= component('ui.skip-link') ?>

    <?php
$navItems = [
    [
        'label' => __('general.nav_home'),
        'href' => base_path('/'.$currentLocale.'/'),
        'active' => $currentPath === '/',
    ],
    [
        'label' => __('general.news_title'),
        'href' => base_path('/'.$currentLocale.'/noticias'),
        'active' => str_starts_with($currentPath, '/noticias'),
    ],
];
?>
    <?= component('ui.header', ['locale' => $currentLocale, 'path' => $currentPath, 'navItems' => $navItems]) ?>

    <?= $content ?? '' ?>

    <?= component('ui.footer') ?>
</body>
</html>
