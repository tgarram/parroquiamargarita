<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.history_title')],
        ],
    ]) ?>

    <?= component('ui.section-header', [
        'id' => 'historia-title',
        'title' => __('general.history_title'),
        'subtitle' => __('general.history_subtitle'),
        'align' => 'left',
    ]) ?>

    <?php if ($historia === null || ! $historia->isPublished()) { ?>

        <div class="mt-8 max-w-2xl">
            <?= component('ui.notice-banner', [
                'message' => __('general.history_pending'),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>

    <?php } else { ?>

        <div class="mt-10 max-w-prose">
            <p class="text-lg leading-relaxed text-[var(--color-text)]">
                <?= nl2br(e($historia->trans('intro', $locale))) ?>
            </p>
        </div>

    <?php } ?>

    <?php if (! empty($timeline)) { ?>

    <!-- Cronología -->
    <section aria-labelledby="timeline-heading" class="mt-16">
        <h2 id="timeline-heading" class="font-serif text-2xl font-semibold text-[var(--color-navy)] mb-8">
            <?= e(__('general.history_timeline')) ?>
        </h2>

        <ol class="relative border-l border-[var(--color-border)] space-y-10 ml-4" aria-label="<?= e(__('general.history_timeline')) ?>">
            <?php foreach ($timeline as $entry) { ?>
            <li class="ml-8">
                <span class="absolute -left-2 mt-1.5 h-4 w-4 rounded-full border border-[var(--color-border)] bg-[var(--color-accent)]" aria-hidden="true"></span>
                <?php if ($entry->get('year')) { ?>
                <time class="mb-1 block text-sm font-semibold text-[var(--color-accent)]">
                    <?= e((string) $entry->get('year')) ?>
                </time>
                <?php } ?>
                <h3 class="font-serif text-lg font-medium text-[var(--color-navy)]">
                    <?= e($entry->trans('title', $locale) ?? '') ?>
                </h3>
                <?php if ($entry->trans('body', $locale)) { ?>
                <p class="mt-2 text-sm leading-relaxed text-[var(--color-muted)]">
                    <?= nl2br(e($entry->trans('body', $locale))) ?>
                </p>
                <?php } ?>
                <?php if ($entry->get('source')) { ?>
                <p class="mt-2 text-xs text-[var(--color-muted)]">
                    <span class="font-medium"><?= e(__('general.history_source')) ?>:</span>
                    <?= e($entry->get('source')) ?>
                </p>
                <?php } ?>
            </li>
            <?php } ?>
        </ol>
    </section>

    <?php } elseif ($historia !== null && $historia->isPublished()) { ?>

        <div class="mt-12 max-w-2xl">
            <?= component('ui.notice-banner', [
                'message' => __('general.history_timeline_pending'),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>

    <?php } ?>

    <!-- CTA visita -->
    <div class="mt-20 rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] px-8 py-10 text-center max-w-2xl">
        <p class="font-serif text-xl text-[var(--color-navy)] mb-4">
            <?= e(__('general.history_cta_text')) ?>
        </p>
        <a
            href="<?= e(base_path('/'.$locale.'/visita')) ?>"
            class="inline-flex items-center gap-2 rounded bg-[var(--color-navy)] px-6 py-3 text-sm font-medium text-white hover:bg-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2"
        >
            <?= e(__('general.history_cta_btn')) ?>
        </a>
    </div>

</main>
