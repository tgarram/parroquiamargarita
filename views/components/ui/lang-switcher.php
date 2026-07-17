<?php
/** @var string $current Active locale code */
/** @var string $path Current path without locale prefix (e.g. '/' or '/laboratorio') */
$locales = [
    'es' => 'Español',
    'ca' => 'Català',
    'en' => 'English',
];
?>
<nav aria-label="Selector de idioma" class="flex items-center gap-1">
<?php foreach ($locales as $code => $label) { ?>
    <?php if ($code === $current) { ?>
        <span
            aria-current="true"
            class="px-2 py-1 text-xs font-medium rounded text-[var(--color-background)] bg-[var(--color-navy)]"
        ><?= e(strtoupper($code)) ?></span>
    <?php } else { ?>
        <a
            href="<?= e(base_path('/'.$code.$path)) ?>"
            hreflang="<?= e($code) ?>"
            class="px-2 py-1 text-xs font-medium rounded text-[var(--color-text-muted)] hover:text-[var(--color-text)] hover:bg-[var(--color-surface)] transition-colors"
        ><?= e(strtoupper($code)) ?></a>
    <?php } ?>
<?php } ?>
</nav>
