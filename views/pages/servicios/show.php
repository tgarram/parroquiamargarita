<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.services_title'), 'href' => base_path('/'.$locale.'/servicios')],
            ['label' => $servicio->trans('title', $locale) ?? ''],
        ],
    ]) ?>

    <div class="mt-8 max-w-3xl">

        <header>
            <p class="text-2xl text-[var(--color-accent)] mb-3" aria-hidden="true">
                <?= e($servicio->get('icon', '✦')) ?>
            </p>
            <h1 id="servicio-title" class="font-serif text-3xl font-semibold text-[var(--color-navy)] sm:text-4xl">
                <?= e($servicio->trans('title', $locale) ?? '') ?>
            </h1>
        </header>

        <?php if (! $servicio->isPublished()) { ?>

            <div class="mt-8">
                <?= component('ui.notice-banner', [
                    'message' => __('general.services_pending'),
                    'variant' => 'info',
                    'dismissible' => false,
                ]) ?>
            </div>

        <?php } else { ?>

            <?php $desc = $servicio->trans('description', $locale); ?>
            <?php if ($desc) { ?>
            <div class="mt-8 text-base leading-relaxed text-[var(--color-text)]">
                <?= nl2br(e($desc)) ?>
            </div>
            <?php } ?>

            <?php $recipients = $servicio->trans('recipients', $locale); ?>
            <?php if ($recipients) { ?>
            <section aria-labelledby="recipients-heading" class="mt-10">
                <h2 id="recipients-heading" class="font-serif text-xl font-semibold text-[var(--color-navy)] mb-3">
                    <?= e(__('general.services_recipients')) ?>
                </h2>
                <p class="text-sm leading-relaxed text-[var(--color-muted)]">
                    <?= nl2br(e($recipients)) ?>
                </p>
            </section>
            <?php } ?>

            <?php $requirements = $servicio->trans('requirements', $locale); ?>
            <?php if ($requirements) { ?>
            <section aria-labelledby="requirements-heading" class="mt-10">
                <h2 id="requirements-heading" class="font-serif text-xl font-semibold text-[var(--color-navy)] mb-3">
                    <?= e(__('general.services_requirements')) ?>
                </h2>
                <p class="text-sm leading-relaxed text-[var(--color-muted)]">
                    <?= nl2br(e($requirements)) ?>
                </p>
            </section>
            <?php } ?>

            <?php $duration = $servicio->trans('duration', $locale); ?>
            <?php if ($duration) { ?>
            <section aria-labelledby="duration-heading" class="mt-10">
                <h2 id="duration-heading" class="font-serif text-xl font-semibold text-[var(--color-navy)] mb-3">
                    <?= e(__('general.services_duration')) ?>
                </h2>
                <p class="text-sm leading-relaxed text-[var(--color-muted)]">
                    <?= e($duration) ?>
                </p>
            </section>
            <?php } ?>

        <?php } ?>

        <!-- CTA solicitar -->
        <div class="mt-12 rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] px-6 py-6">
            <p class="text-sm text-[var(--color-muted)] mb-4">
                <?= e(__('general.services_request_note')) ?>
            </p>
            <a
                href="<?= e(base_path('/'.$locale.'/contacto')) ?>"
                class="inline-flex items-center gap-2 rounded bg-[var(--color-navy)] px-6 py-3 text-sm font-medium text-white hover:bg-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2"
            >
                <?= e(__('general.services_request_btn')) ?>
            </a>
        </div>

        <!-- Volver -->
        <div class="mt-8">
            <a
                href="<?= e(base_path('/'.$locale.'/servicios')) ?>"
                class="text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2 focus-visible:rounded"
            >
                ← <?= e(__('general.services_back')) ?>
            </a>
        </div>

    </div>

</main>
