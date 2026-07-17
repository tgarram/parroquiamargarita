<?php
/**
 * Breadcrumbs
 *
 * Props:
 *   $items  array  [ ['label' => '...', 'href' => '...'], ... ]
 *                  El último ítem se trata como current (sin href requerido)
 */
$items = $items ?? [];
$last = count($items) - 1;
?>
<nav aria-label="<?= __('general.breadcrumb') ?>">
    <ol class="flex flex-wrap items-center gap-1 text-sm text-[--color-muted]">
        <?php foreach ($items as $i => $item) { ?>
        <?php if ($i === $last) { ?>
        <li>
            <span class="text-[--color-text] font-medium" aria-current="page"><?= e($item['label']) ?></span>
        </li>
        <?php } else { ?>
        <li class="flex items-center gap-1">
            <a href="<?= e($item['href'] ?? '#') ?>"
               class="hover:text-[--color-text] transition-colors underline underline-offset-2">
                <?= e($item['label']) ?>
            </a>
            <span aria-hidden="true" class="text-[--color-border]">›</span>
        </li>
        <?php } ?>
        <?php } ?>
    </ol>
</nav>
