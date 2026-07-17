<?php
/**
 * Button / CTA
 *
 * Props:
 *   $label    string  Texto del botón (requerido)
 *   $variant  string  primary | secondary | ghost | danger  [primary]
 *   $size     string  sm | base | lg                        [base]
 *   $tag      string  button | a                            [button]
 *   $href     string  Solo para tag=a
 *   $type     string  button | submit | reset               [button]
 *   $disabled bool                                          [false]
 *   $class    string  Clases adicionales
 *   $attrs    string  Atributos HTML extra (raw)
 */
$label = $label ?? '';
$variant = $variant ?? 'primary';
$size = $size ?? 'base';
$tag = $tag ?? 'button';
$href = $href ?? '#';
$type = $type ?? 'button';
$disabled = $disabled ?? false;
$class = $class ?? '';
$attrs = $attrs ?? '';

$base = 'inline-flex items-center justify-center font-sans font-medium tracking-wide rounded-md transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[--color-navy] focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';

$variants = [
    'primary' => 'bg-[--color-navy] text-[--color-surface] hover:bg-[--color-text]',
    'secondary' => 'border border-[--color-navy] text-[--color-navy] bg-transparent hover:bg-[--color-background]',
    'ghost' => 'text-[--color-navy] bg-transparent hover:bg-[--color-background]',
    'danger' => 'bg-[--color-error] text-[--color-surface] hover:opacity-90',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs gap-1.5',
    'base' => 'px-5 py-2.5 text-sm gap-2',
    'lg' => 'px-7 py-3.5 text-base gap-2.5',
];

$classes = implode(' ', array_filter([
    $base,
    $variants[$variant] ?? $variants['primary'],
    $sizes[$size] ?? $sizes['base'],
    $class,
]));

$disabledAttr = $disabled ? 'disabled aria-disabled="true"' : '';
?>

<?php if ($tag === 'a') { ?>
<a href="<?= e($href) ?>" class="<?= e($classes) ?>" <?= $attrs ?>>
    <?= $label ?>
</a>
<?php } else { ?>
<button type="<?= e($type) ?>" class="<?= e($classes) ?>" <?= $disabledAttr ?> <?= $attrs ?>>
    <?= $label ?>
</button>
<?php } ?>
