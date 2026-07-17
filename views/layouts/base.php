<!doctype html>
<html lang="<?= e(config('app.locale', 'es')) ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= e($description ?? '') ?>">
    <title><?= isset($title) ? e($title).' · ' : '' ?><?= e(config('app.name', '')) ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <?= vite('resources/js/app.js') ?>
</head>
<body x-data>
    <?= component('ui.skip-link') ?>

    <?= $content ?? '' ?>

    <?= component('ui.footer') ?>
</body>
</html>
