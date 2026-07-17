<?php
/**
 * Footer
 *
 * Props:
 *   $year  int   Año de copyright   [año actual]
 */
$year = $year ?? (int) date('Y');
?>
<footer class="mt-24 border-t border-[--color-border] bg-[--color-surface]" role="contentinfo">
    <div class="mx-auto max-w-7xl px-6 py-12 flex flex-col sm:flex-row items-center justify-between gap-6">

        <div class="text-center sm:text-left">
            <p class="text-xs uppercase tracking-widest text-[--color-muted] mb-1">
                <?= __('general.site_name') ?>
            </p>
            <p class="text-xs text-[--color-muted]">
                &copy; <?= $year ?> — <?= __('general.footer_rights') ?>
            </p>
        </div>

        <nav aria-label="<?= __('general.footer_nav') ?>">
            <ul class="flex flex-wrap gap-x-6 gap-y-2 justify-center text-xs text-[--color-muted]">
                <li><a href="/" class="hover:text-[--color-text] transition-colors"><?= __('general.nav_home') ?></a></li>
            </ul>
        </nav>

    </div>
</footer>
