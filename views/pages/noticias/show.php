<main id="main" class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'),   'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.news_title'), 'href' => base_path('/'.$locale.'/noticias')],
            ['label' => $noticia->trans('title', $locale)],
        ],
    ]) ?>

    <article aria-labelledby="noticia-title" class="mt-8">

        <?php if ($noticia->get('date')) { ?>
        <p class="text-xs uppercase tracking-widest text-[var(--color-muted)] mb-4 font-medium">
            <?= e(__('general.news_published_on')) ?> <?= e($noticia->get('date')) ?>
        </p>
        <?php } ?>

        <h1 id="noticia-title" class="mb-8">
            <?= e($noticia->trans('title', $locale)) ?>
        </h1>

        <?php if ($noticia->trans('body', $locale)) { ?>
        <div class="prose max-w-none text-[var(--color-text)] leading-relaxed space-y-4">
            <?= $noticia->trans('body', $locale) ?>
        </div>
        <?php } else { ?>
        <p class="text-[var(--color-muted)] italic">
            <?= e(__('general.news_empty')) ?>
        </p>
        <?php } ?>

    </article>

    <div class="mt-12 pt-8 border-t border-[var(--color-border)]">
        <?= component('ui.button', [
            'label' => __('general.news_back'),
            'tag' => 'a',
            'href' => base_path('/'.$locale.'/noticias'),
            'variant' => 'ghost',
        ]) ?>
    </div>

</main>
