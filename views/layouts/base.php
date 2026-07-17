<!doctype html>
<html lang="<?= e($locale ?? config('app.locale', 'es')) ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $currentLocale = $locale ?? config('app.locale', 'es');
$currentPath = $path ?? '/';
$metaDesc = $description ?? __('general.meta_site_description');
$canonicalUrl = config('app.url', '').'/'.$currentLocale.$currentPath;
?>
    <meta name="description" content="<?= e($metaDesc) ?>">
    <link rel="canonical" href="<?= e($canonicalUrl) ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonicalUrl) ?>">
    <meta property="og:site_name" content="<?= e(config('app.name', '')) ?>">
    <meta property="og:title" content="<?= isset($title) ? e($title).' · '.e(config('app.name', '')) : e(config('app.name', '')) ?>">
    <meta property="og:description" content="<?= e($metaDesc) ?>">
    <meta property="og:locale" content="<?= e(match ($currentLocale) {
        'ca' => 'ca_ES', 'en' => 'en_GB', default => 'es_ES'
    }) ?>">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?= isset($title) ? e($title).' · '.e(config('app.name', '')) : e(config('app.name', '')) ?>">
    <meta name="twitter:description" content="<?= e($metaDesc) ?>">

    <title><?= isset($title) ? e($title).' · ' : '' ?><?= e(config('app.name', '')) ?></title>

    <?php foreach (['es', 'ca', 'en'] as $loc) { ?>
    <link rel="alternate" hreflang="<?= e($loc) ?>" href="<?= e(config('app.url', '').'/'.$loc.$currentPath) ?>">
    <?php } ?>
    <link rel="alternate" hreflang="x-default" href="<?= e(config('app.url', '').'/es'.$currentPath) ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <?= vite('resources/js/app.js') ?>

    <?php
    $orgSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ReligiousOrganization',
        'name' => config('app.name', ''),
        'url' => $canonicalUrl,
        'inLanguage' => $currentLocale,
    ];
$ldSchema = $jsonLd ?? $orgSchema;
echo component('ui.json-ld', ['schema' => $ldSchema]);
?>
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
    [
        'label' => __('general.about_title'),
        'href' => base_path('/'.$currentLocale.'/sobre'),
        'active' => $currentPath === '/sobre',
    ],
    [
        'label' => __('general.schedules_title'),
        'href' => base_path('/'.$currentLocale.'/horarios'),
        'active' => $currentPath === '/horarios',
    ],
    [
        'label' => __('general.contact_title'),
        'href' => base_path('/'.$currentLocale.'/contacto'),
        'active' => $currentPath === '/contacto',
    ],
];
?>
    <?= component('ui.header', ['locale' => $currentLocale, 'path' => $currentPath, 'navItems' => $navItems]) ?>

    <?= $content ?? '' ?>

    <?= component('ui.footer', ['locale' => $currentLocale]) ?>
</body>
</html>
