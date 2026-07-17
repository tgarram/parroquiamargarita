<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.news_title')],
        ],
    ]) ?>

    <?= component('ui.section-header', [
        'id' => 'noticias-title',
        'title' => __('general.news_title'),
        'align' => 'left',
    ]) ?>

    <?php if (empty($noticias)) { ?>
        <div class="mt-8">
            <?= component('ui.notice-banner', [
                'message' => __('general.news_empty'),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>
    <?php } else { ?>
        <ul class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3" role="list">
            <?php foreach ($noticias as $noticia) { ?>
            <li>
                <?php
                $cardContent = '<h2 class="font-serif text-lg font-semibold text-[var(--color-text)] mb-2">'
                    .e($noticia->trans('title', $locale))
                    .'</h2>';

                if ($noticia->get('date')) {
                    $cardContent .= '<p class="text-xs text-[var(--color-muted)] mb-3">'
                        .e(__('general.news_published_on')).' '
                        .e($noticia->get('date'))
                        .'</p>';
                }

                if ($noticia->trans('excerpt', $locale)) {
                    $cardContent .= '<p class="text-sm text-[var(--color-muted)] mb-4 line-clamp-3">'
                        .e($noticia->trans('excerpt', $locale))
                        .'</p>';
                }

                $cardContent .= '<a href="'.e(base_path('/'.$locale.'/noticias/'.$noticia->slug)).'"'
                    .' class="text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors">'
                    .e(__('general.news_read_more')).' →</a>';
                ?>
                <?= component('ui.card', ['variant' => 'bordered', 'slot' => $cardContent]) ?>
            </li>
            <?php } ?>
        </ul>
    <?php } ?>

</main>
