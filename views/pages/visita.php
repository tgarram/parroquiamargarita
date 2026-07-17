<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.visit_title')],
        ],
    ]) ?>

    <?= component('ui.section-header', [
        'id' => 'visita-title',
        'title' => __('general.visit_title'),
        'subtitle' => __('general.visit_subtitle'),
        'align' => 'left',
    ]) ?>

    <?php if ($visita === null || ! $visita->isPublished()) { ?>

        <div class="mt-8 max-w-2xl">
            <?= component('ui.notice-banner', [
                'message' => __('general.visit_pending'),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>

    <?php } else { ?>

        <div class="mt-10 grid gap-10 lg:grid-cols-2">

            <!-- Columna izquierda: información práctica -->
            <div class="space-y-8">

                <?php $address = $visita->trans('address', $locale); ?>
                <?php if ($address) { ?>
                <section aria-labelledby="address-heading">
                    <h2 id="address-heading" class="font-serif text-xl font-semibold text-[var(--color-navy)] mb-3">
                        <?= e(__('general.visit_address')) ?>
                    </h2>
                    <address class="not-italic text-sm leading-relaxed text-[var(--color-text)]">
                        <?= nl2br(e($address)) ?>
                    </address>
                </section>
                <?php } ?>

                <?php $hours = $visita->trans('opening_hours', $locale); ?>
                <?php if ($hours) { ?>
                <section aria-labelledby="hours-heading">
                    <h2 id="hours-heading" class="font-serif text-xl font-semibold text-[var(--color-navy)] mb-3">
                        <?= e(__('general.visit_opening_hours')) ?>
                    </h2>
                    <p class="text-sm leading-relaxed text-[var(--color-text)]">
                        <?= nl2br(e($hours)) ?>
                    </p>
                </section>
                <?php } ?>

                <?php $howToGet = $visita->trans('how_to_get', $locale); ?>
                <?php if ($howToGet) { ?>
                <section aria-labelledby="howtoget-heading">
                    <h2 id="howtoget-heading" class="font-serif text-xl font-semibold text-[var(--color-navy)] mb-3">
                        <?= e(__('general.visit_how_to_get')) ?>
                    </h2>
                    <p class="text-sm leading-relaxed text-[var(--color-text)]">
                        <?= nl2br(e($howToGet)) ?>
                    </p>
                </section>
                <?php } ?>

                <?php $accessibility = $visita->trans('accessibility_info', $locale); ?>
                <?php if ($accessibility) { ?>
                <section aria-labelledby="visitacc-heading">
                    <h2 id="visitacc-heading" class="font-serif text-xl font-semibold text-[var(--color-navy)] mb-3">
                        <?= e(__('general.visit_accessibility')) ?>
                    </h2>
                    <p class="text-sm leading-relaxed text-[var(--color-text)]">
                        <?= nl2br(e($accessibility)) ?>
                    </p>
                </section>
                <?php } ?>

            </div>

            <!-- Columna derecha: mapa placeholder -->
            <div class="rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] p-6 flex items-center justify-center min-h-[280px]">
                <p class="text-sm text-[var(--color-muted)] text-center max-w-[200px]">
                    <?= e(__('general.visit_map_placeholder')) ?>
                </p>
            </div>

        </div>

    <?php } ?>

    <!-- CTA contacto -->
    <div class="mt-16 rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] px-8 py-8 max-w-2xl">
        <p class="text-sm text-[var(--color-muted)] mb-3">
            <?= e(__('general.visit_contact_note')) ?>
        </p>
        <a
            href="<?= e(base_path('/'.$locale.'/contacto')) ?>"
            class="inline-flex items-center gap-2 text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2 focus-visible:rounded"
        >
            <?= e(__('general.visit_contact_link')) ?> →
        </a>
    </div>

</main>
