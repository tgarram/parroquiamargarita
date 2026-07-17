<?php
/**
 * @var string $locale      Active locale (es/ca/en)
 * @var string $path        Current path without locale prefix (e.g. '/' or '/laboratorio')
 * @var array $navItems    [['label' => string, 'href' => string, 'active' => bool], ...]
 */
$navItems = $navItems ?? [];
?>
<header
    x-data="{ open: false }"
    class="sticky top-0 z-40 border-b border-[var(--color-border)] bg-[var(--color-background)]/95 backdrop-blur-sm"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-6">

            <!-- Logotipo -->
            <a
                href="<?= e(base_path('/'.$locale.'/')) ?>"
                class="shrink-0 font-serif text-sm font-semibold leading-tight tracking-wide text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:rounded"
            >
                <?= e(__('general.site_name')) ?>
            </a>

            <!-- Navegación escritorio -->
            <nav aria-label="<?= e(__('general.nav_main')) ?>" class="hidden md:flex items-center gap-1">
                <?php foreach ($navItems as $item) { ?>
                <a
                    href="<?= e($item['href']) ?>"
                    <?= isset($item['active']) && $item['active'] ? 'aria-current="page"' : '' ?>
                    class="px-3 py-2 text-sm font-medium rounded transition-colors
                        <?= (isset($item['active']) && $item['active'])
                            ? 'text-[var(--color-navy)] bg-[var(--color-surface)]'
                            : 'text-[var(--color-text-muted,var(--color-muted))] hover:text-[var(--color-text)] hover:bg-[var(--color-surface)]' ?>"
                >
                    <?= e($item['label']) ?>
                </a>
                <?php } ?>
            </nav>

            <!-- Derecha: lang-switcher + hamburguesa -->
            <div class="flex items-center gap-3">
                <?= component('ui.lang-switcher', ['current' => $locale, 'path' => $path]) ?>

                <!-- Botón hamburguesa (solo móvil) -->
                <button
                    type="button"
                    class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded text-[var(--color-text)] hover:bg-[var(--color-surface)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2"
                    @click="open = !open"
                    :aria-expanded="open.toString()"
                    :aria-label="open ? '<?= e(__('general.nav_close_menu')) ?>' : '<?= e(__('general.nav_open_menu')) ?>'"
                >
                    <!-- Icono hamburgesa -->
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                    <!-- Icono cierre -->
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        class="md:hidden border-t border-[var(--color-border)] bg-[var(--color-background)]"
        @click.outside="open = false"
        id="mobile-menu"
    >
        <nav aria-label="<?= e(__('general.nav_main')) ?>" class="mx-auto max-w-7xl px-4 py-3 flex flex-col gap-1">
            <?php foreach ($navItems as $item) { ?>
            <a
                href="<?= e($item['href']) ?>"
                <?= isset($item['active']) && $item['active'] ? 'aria-current="page"' : '' ?>
                @click="open = false"
                class="px-3 py-2.5 text-sm font-medium rounded transition-colors
                    <?= (isset($item['active']) && $item['active'])
                        ? 'text-[var(--color-navy)] bg-[var(--color-surface)]'
                        : 'text-[var(--color-muted)] hover:text-[var(--color-text)] hover:bg-[var(--color-surface)]' ?>"
            >
                <?= e($item['label']) ?>
            </a>
            <?php } ?>
        </nav>
    </div>
</header>
