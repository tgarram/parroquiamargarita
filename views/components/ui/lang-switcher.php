<?php
/**
 * Lang-switcher
 *
 * Props:
 *   $current  string  Active locale code (es/ca/en)
 *   $path     string  Current path without locale prefix
 */
$locales = [
    'es' => 'Español',
    'ca' => 'Català',
    'en' => 'English',
];
?>
<nav aria-label="<?= e(__('general.lang_switcher_label')) ?>" class="flex items-center gap-1">
    <?php foreach ($locales as $code => $label) { ?>
        <?php if ($code === $current) { ?>
        <span
            aria-current="true"
            aria-label="<?= e($label) ?>"
            class="inline-flex items-center justify-center min-w-[2rem] min-h-[1.75rem] px-2 py-1 text-xs font-semibold rounded text-[var(--color-background)] bg-[var(--color-navy)]"
        ><?= e(strtoupper($code)) ?></span>
        <?php } else { ?>
        <a
            href="<?= e(base_path('/'.$code.$path)) ?>"
            hreflang="<?= e($code) ?>"
            lang="<?= e($code) ?>"
            aria-label="<?= e($label) ?>"
            class="inline-flex items-center justify-center min-w-[2rem] min-h-[1.75rem] px-2 py-1 text-xs font-medium rounded text-[var(--color-muted)] hover:text-[var(--color-text)] hover:bg-[var(--color-surface)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2"
        ><?= e(strtoupper($code)) ?></a>
        <?php } ?>
    <?php } ?>
</nav>
