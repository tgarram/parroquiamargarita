<?php
/**
 * Card
 *
 * Props:
 *   $slot     string  Contenido HTML interior (requerido)
 *   $variant  string  default | bordered | elevated   [default]
 *   $class    string  Clases adicionales
 *   $tag      string  div | article | section         [div]
 */
$slot = $slot ?? '';
$variant = $variant ?? 'default';
$class = $class ?? '';
$tag = $tag ?? 'div';

$variants = [
    'default' => 'bg-[--color-surface] rounded-lg p-6',
    'bordered' => 'bg-[--color-surface] rounded-lg p-6 border border-[--color-border]',
    'elevated' => 'bg-[--color-surface] rounded-lg p-6 shadow-md',
];

$classes = implode(' ', array_filter([
    $variants[$variant] ?? $variants['default'],
    $class,
]));
?>
<<?= e($tag) ?> class="<?= e($classes) ?>">
    <?= $slot ?>
</<?= e($tag) ?>>
