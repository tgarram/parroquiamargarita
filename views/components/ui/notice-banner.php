<?php
/**
 * NoticeBanner
 *
 * Props:
 *   $message      string  Texto del aviso (HTML permitido)
 *   $variant      string  info | warning | success | error   [info]
 *   $dismissible  bool    Muestra botón de cierre           [false]
 *   $icon         bool    Muestra icono SVG                 [true]
 */
$message = $message ?? '';
$variant = $variant ?? 'info';
$dismissible = $dismissible ?? false;
$icon = $icon ?? true;

$styles = [
    'info' => ['bg-[--color-navy]/8 border-[--color-navy]/20 text-[--color-navy]',     'M11 9h2v6h-2zm0-4h2v2h-2z'],
    'warning' => ['bg-[--color-gold]/10 border-[--color-gold]/30 text-[--color-text]',    'M11 9h2v6h-2zm0-4h2v2h-2z'],
    'success' => ['bg-[--color-success]/8 border-[--color-success]/20 text-[--color-success]', 'M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z'],
    'error' => ['bg-[--color-error]/8 border-[--color-error]/20 text-[--color-error]',  'M12 9v4m0 4h.01M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z'],
];

[$bannerClass, $iconPath] = $styles[$variant] ?? $styles['info'];
?>
<div
    class="flex items-start gap-3 rounded-lg border px-4 py-3 text-sm <?= e($bannerClass) ?>"
    role="<?= $variant === 'error' ? 'alert' : 'status' ?>"
    <?= $dismissible ? 'x-data="{ show: true }" x-show="show"' : '' ?>
>
    <?php if ($icon) { ?>
    <svg class="mt-0.5 h-4 w-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="<?= e($iconPath) ?>"/>
    </svg>
    <?php } ?>

    <div class="flex-1"><?= $message ?></div>

    <?php if ($dismissible) { ?>
    <button
        type="button"
        @click="show = false"
        class="ml-auto flex-shrink-0 opacity-60 hover:opacity-100 transition-opacity"
        aria-label="<?= __('general.close') ?>"
    >
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"/>
        </svg>
    </button>
    <?php } ?>
</div>
