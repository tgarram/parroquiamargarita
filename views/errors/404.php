<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-32 text-center">
    <p class="text-xs uppercase tracking-[0.2em] text-[var(--color-muted)] mb-6 font-medium">404</p>
    <h1 class="mb-4"><?= e(__('general.page_not_found')) ?></h1>
    <p class="text-[var(--color-muted)] max-w-sm mx-auto mb-10">
        <?= e(__('general.page_not_found_desc')) ?>
    </p>
    <?= component('ui.button', [
        'label' => __('general.nav_home'),
        'tag' => 'a',
        'href' => base_path('/'.(isset($locale) ? $locale : config('app.locale', 'es')).'/'),
        'variant' => 'primary',
    ]) ?>
</main>
