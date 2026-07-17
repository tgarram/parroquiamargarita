<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.contact_title')],
        ],
    ]) ?>

    <?= component('ui.section-header', [
        'id' => 'contacto-title',
        'title' => __('general.contact_title'),
        'subtitle' => __('general.contact_subtitle'),
        'align' => 'left',
    ]) ?>

    <?php if ($contacto === null || ! $contacto->isPublished()) { ?>

        <div class="mt-8 max-w-2xl">
            <?= component('ui.notice-banner', [
                'message' => __('general.contact_pending'),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>

    <?php } else { ?>

        <div class="mt-10 grid gap-8 sm:grid-cols-2 max-w-3xl">

            <?php if ($contacto->trans('address', $locale)) { ?>
            <div>
                <h2 class="text-xs uppercase tracking-widest text-[var(--color-muted)] font-semibold mb-3">
                    <?= e(__('general.contact_address')) ?>
                </h2>
                <p class="text-[var(--color-text)] leading-relaxed">
                    <?= nl2br(e($contacto->trans('address', $locale))) ?>
                </p>
            </div>
            <?php } ?>

            <?php if ($contacto->get('phone')) { ?>
            <div>
                <h2 class="text-xs uppercase tracking-widest text-[var(--color-muted)] font-semibold mb-3">
                    <?= e(__('general.contact_phone')) ?>
                </h2>
                <a
                    href="tel:<?= e(preg_replace('/\s+/', '', $contacto->get('phone'))) ?>"
                    class="text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors font-medium"
                >
                    <?= e($contacto->get('phone')) ?>
                </a>
            </div>
            <?php } ?>

            <?php if ($contacto->get('email')) { ?>
            <div>
                <h2 class="text-xs uppercase tracking-widest text-[var(--color-muted)] font-semibold mb-3">
                    <?= e(__('general.contact_email')) ?>
                </h2>
                <a
                    href="mailto:<?= e($contacto->get('email')) ?>"
                    class="text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors font-medium"
                >
                    <?= e($contacto->get('email')) ?>
                </a>
            </div>
            <?php } ?>

            <?php if ($contacto->trans('hours', $locale)) { ?>
            <div>
                <h2 class="text-xs uppercase tracking-widest text-[var(--color-muted)] font-semibold mb-3">
                    <?= e(__('general.contact_hours')) ?>
                </h2>
                <p class="text-[var(--color-text)] leading-relaxed">
                    <?= nl2br(e($contacto->trans('hours', $locale))) ?>
                </p>
            </div>
            <?php } ?>

        </div>

    <?php } ?>

</main>
