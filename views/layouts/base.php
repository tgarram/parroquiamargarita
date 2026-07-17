<!doctype html>
<html lang="<?= e($locale ?? config('app.locale', 'es')) ?>" class="scroll-smooth">
<head>
    <!-- 1. Encoding & viewport — must be first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    $currentLocale = $locale ?? config('app.locale', 'es');
$currentPath = $path ?? '/';
$metaDesc = $description ?? __('general.meta_site_description');
$canonicalUrl = config('app.url', '').'/'.$currentLocale.$currentPath;
$ogTitle = isset($title) ? e($title).' · '.e(config('app.name', '')) : e(config('app.name', ''));
?>

    <!-- 2. Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>✝</text></svg>">

    <!-- 3. Theme color (mobile browser chrome) -->
    <meta name="theme-color" content="#172734" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#172734" media="(prefers-color-scheme: dark)">

    <!-- 4. SEO -->
    <title><?= isset($title) ? e($title).' · ' : '' ?><?= e(config('app.name', '')) ?></title>
    <meta name="description" content="<?= e($metaDesc) ?>">
    <link rel="canonical" href="<?= e($canonicalUrl) ?>">

    <!-- 5a. RSS feed autodiscovery -->
    <link rel="alternate" type="application/rss+xml" title="<?= e(config('app.name', '')) ?>" href="<?= e(config('app.url', '').'/feed.xml') ?>">

    <!-- 5. Hreflang alternates -->
    <?php foreach (['es', 'ca', 'en'] as $loc) { ?>
    <link rel="alternate" hreflang="<?= e($loc) ?>" href="<?= e(config('app.url', '').'/'.$loc.$currentPath) ?>">
    <?php } ?>
    <link rel="alternate" hreflang="x-default" href="<?= e(config('app.url', '').'/es'.$currentPath) ?>">

    <!-- 6. Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonicalUrl) ?>">
    <meta property="og:site_name" content="<?= e(config('app.name', '')) ?>">
    <meta property="og:title" content="<?= $ogTitle ?>">
    <meta property="og:description" content="<?= e($metaDesc) ?>">
    <meta property="og:locale" content="<?= e(match ($currentLocale) {
        'ca' => 'ca_ES', 'en' => 'en_GB', default => 'es_ES'
    }) ?>">

    <!-- 7. Twitter / X -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?= $ogTitle ?>">
    <meta name="twitter:description" content="<?= e($metaDesc) ?>">

    <!-- 8. Fonts: dns-prefetch + preconnect, then stylesheet -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Inter (UI font) loads normally; Playfair Display (display font) loads async to avoid render-blocking -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet"></noscript>

    <!-- 9. Assets -->
    <?= vite('resources/js/app.js') ?>

    <!-- 10. JSON-LD -->
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
        'label' => __('general.nav_history'),
        'href' => base_path('/'.$currentLocale.'/historia'),
        'active' => str_starts_with($currentPath, '/historia'),
    ],
    [
        'label' => __('general.nav_services'),
        'href' => base_path('/'.$currentLocale.'/servicios'),
        'active' => str_starts_with($currentPath, '/servicios'),
    ],
    [
        'label' => __('general.news_title'),
        'href' => base_path('/'.$currentLocale.'/noticias'),
        'active' => str_starts_with($currentPath, '/noticias'),
    ],
    [
        'label' => __('general.schedules_title'),
        'href' => base_path('/'.$currentLocale.'/horarios'),
        'active' => $currentPath === '/horarios',
    ],
    [
        'label' => __('general.nav_visit'),
        'href' => base_path('/'.$currentLocale.'/visita'),
        'active' => $currentPath === '/visita',
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
