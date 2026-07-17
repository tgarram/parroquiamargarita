<?php
/**
 * SectionHeader
 *
 * Props:
 *   $eyebrow   string  Texto pequeño sobre el título
 *   $title     string  Título principal (requerido)
 *   $subtitle  string  Texto descriptivo bajo el título
 *   $align     string  left | center                   [left]
 *   $id        string  ID del elemento h2 (para aria)
 */
$eyebrow = $eyebrow ?? '';
$title = $title ?? '';
$subtitle = $subtitle ?? '';
$align = $align ?? 'left';
$id = $id ?? '';

$alignClass = $align === 'center' ? 'text-center mx-auto' : '';
$idAttr = $id !== '' ? ' id="'.e($id).'"' : '';
?>
<div class="mb-12 <?= e($alignClass) ?>">
    <?php if ($eyebrow !== '') { ?>
    <p class="text-xs font-medium uppercase tracking-widest text-[--color-muted] mb-3"><?= e($eyebrow) ?></p>
    <?php } ?>

    <h2<?= $idAttr ?> class="text-[--color-text]"><?= e($title) ?></h2>

    <?php if ($subtitle !== '') { ?>
    <p class="mt-4 text-lg text-[--color-muted] max-w-2xl <?= $align === 'center' ? 'mx-auto' : '' ?>"><?= e($subtitle) ?></p>
    <?php } ?>
</div>
