<?php
/**
 * SkipLink
 *
 * Props:
 *   $target  string  ID del elemento de destino   [main]
 */
$target = $target ?? 'main';
?>
<a href="#<?= e($target) ?>" class="skip-link"><?= __('general.skip_to_content') ?></a>
