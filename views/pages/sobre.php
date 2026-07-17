<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.about_title')],
        ],
    ]) ?>

    <?= component('ui.section-header', [
        'id' => 'sobre-title',
        'title' => __('general.about_title'),
        'subtitle' => __('general.about_subtitle'),
        'align' => 'left',
    ]) ?>

    <?php if ($sobre === null || ! $sobre->isPublished()) { ?>

        <div class="mt-8 max-w-2xl">
            <?= component('ui.notice-banner', [
                'message' => __('general.about_pending'),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>

    <?php } else { ?>

        <article
            id="sobre-content"
            aria-labelledby="sobre-title"
            class="mt-10 max-w-prose prose prose-neutral dark:prose-invert leading-relaxed text-[var(--color-text)]"
        >
            <?= nl2br(e($sobre->trans('body', $locale))) ?>
        </article>

    <?php } ?>

</main>
