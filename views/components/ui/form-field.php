<?php
/**
 * FormField
 *
 * Props:
 *   $name        string  Nombre del campo (requerido)
 *   $label       string  Etiqueta visible
 *   $type        string  text | email | tel | textarea | select   [text]
 *   $value       string  Valor actual
 *   $placeholder string
 *   $required    bool    [false]
 *   $error       string  Mensaje de error
 *   $hint        string  Texto de ayuda bajo el campo
 *   $options     array   Solo para type=select: ['value' => 'label', ...]
 *   $rows        int     Solo para textarea                        [4]
 */
$name = $name ?? '';
$label = $label ?? '';
$type = $type ?? 'text';
$value = $value ?? '';
$placeholder = $placeholder ?? '';
$required = $required ?? false;
$error = $error ?? '';
$hint = $hint ?? '';
$options = $options ?? [];
$rows = $rows ?? 4;

$fieldId = 'field-'.e($name);
$hasError = $error !== '';
$errorClass = $hasError ? 'border-[--color-error]' : 'border-[--color-border]';
$baseInput = 'w-full rounded-md bg-[--color-surface] px-3.5 py-2.5 text-sm text-[--color-text] placeholder:text-[--color-muted] border focus:outline-none focus:ring-2 focus:ring-[--color-navy] focus:ring-offset-1 transition-colors '.$errorClass;

$reqAttr = $required ? ' required aria-required="true"' : '';
$errAttr = $hasError ? ' aria-describedby="'.$fieldId.'-error"' : '';
?>
<div class="space-y-1.5">
    <?php if ($label !== '') { ?>
    <label for="<?= $fieldId ?>" class="block text-sm font-medium text-[--color-text]">
        <?= e($label) ?>
        <?php if ($required) { ?>
        <span class="text-[--color-error] ml-0.5" aria-hidden="true">*</span>
        <?php } ?>
    </label>
    <?php } ?>

    <?php if ($type === 'textarea') { ?>
    <textarea
        id="<?= $fieldId ?>"
        name="<?= e($name) ?>"
        rows="<?= (int) $rows ?>"
        placeholder="<?= e($placeholder) ?>"
        class="<?= $baseInput ?> resize-y"
        <?= $reqAttr.$errAttr ?>
    ><?= e($value) ?></textarea>

    <?php } elseif ($type === 'select') { ?>
    <select
        id="<?= $fieldId ?>"
        name="<?= e($name) ?>"
        class="<?= $baseInput ?>"
        <?= $reqAttr.$errAttr ?>
    >
        <?php if ($placeholder !== '') { ?>
        <option value="" disabled selected><?= e($placeholder) ?></option>
        <?php } ?>
        <?php foreach ($options as $optVal => $optLabel) { ?>
        <option value="<?= e((string) $optVal) ?>" <?= $value === (string) $optVal ? 'selected' : '' ?>>
            <?= e($optLabel) ?>
        </option>
        <?php } ?>
    </select>

    <?php } else { ?>
    <input
        id="<?= $fieldId ?>"
        type="<?= e($type) ?>"
        name="<?= e($name) ?>"
        value="<?= e($value) ?>"
        placeholder="<?= e($placeholder) ?>"
        class="<?= $baseInput ?>"
        <?= $reqAttr.$errAttr ?>
    >
    <?php } ?>

    <?php if ($hasError) { ?>
    <p id="<?= $fieldId ?>-error" class="text-xs text-[--color-error]" role="alert"><?= e($error) ?></p>
    <?php } elseif ($hint !== '') { ?>
    <p class="text-xs text-[--color-muted]"><?= e($hint) ?></p>
    <?php } ?>
</div>
