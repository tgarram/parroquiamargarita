<?php
/**
 * Accordion
 *
 * Props:
 *   $items     array   [ ['title' => '...', 'content' => '...'], ... ]
 *   $open_all  bool    Si true, todos abiertos por defecto   [false]
 *   $id        string  Prefijo de ID para aria
 */
$items = $items ?? [];
$openAll = $open_all ?? false;
$id = $id ?? 'accordion-'.uniqid();
?>
<div class="divide-y divide-[--color-border] border border-[--color-border] rounded-lg overflow-hidden"
     x-data="{ open: <?= $openAll ? 'Array.from({length: '.count($items).'}, (_, i) => i)' : '[]' ?> }">

    <?php foreach ($items as $i => $item) { ?>
    <div>
        <button
            type="button"
            class="w-full flex items-center justify-between px-6 py-4 text-left text-[--color-text] font-medium hover:bg-[--color-background] transition-colors"
            @click="open.includes(<?= $i ?>) ? open = open.filter(v => v !== <?= $i ?>) : open.push(<?= $i ?>)"
            :aria-expanded="open.includes(<?= $i ?>)"
            aria-controls="<?= e($id) ?>-panel-<?= $i ?>"
            id="<?= e($id) ?>-btn-<?= $i ?>"
        >
            <span><?= e($item['title']) ?></span>
            <svg
                class="w-4 h-4 text-[--color-muted] transition-transform duration-[200ms]"
                :class="open.includes(<?= $i ?>) ? 'rotate-180' : ''"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
            </svg>
        </button>

        <div
            id="<?= e($id) ?>-panel-<?= $i ?>"
            role="region"
            aria-labelledby="<?= e($id) ?>-btn-<?= $i ?>"
            x-show="open.includes(<?= $i ?>)"
            x-transition:enter="transition duration-[200ms] ease-out"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition duration-[150ms] ease-in"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-1"
            style="display: none"
        >
            <div class="px-6 pb-5 text-[--color-muted] leading-relaxed">
                <?= $item['content'] ?>
            </div>
        </div>
    </div>
    <?php } ?>

</div>
