<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.services_title')],
        ],
    ]) ?>

    <?= component('ui.section-header', [
        'id' => 'servicios-title',
        'title' => __('general.services_title'),
        'subtitle' => __('general.services_subtitle'),
        'align' => 'left',
    ]) ?>

    <?php if (empty($servicios)) { ?>

        <div class="mt-8 max-w-2xl">
            <?= component('ui.notice-banner', [
                'message' => __('general.services_pending'),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>

    <?php } else { ?>

    <!-- Catálogo de servicios -->
    <section aria-labelledby="servicios-title" class="mt-12">
        <ul
            role="list"
            class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
        >
            <?php foreach ($servicios as $servicio) { ?>
            <li>
                <a
                    href="<?= e(base_path('/'.$locale.'/servicios/'.$servicio->slug)) ?>"
                    class="group flex flex-col h-full rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] p-6 hover:border-[var(--color-navy)] hover:shadow-md transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2"
                >
                    <span class="text-2xl mb-3 text-[var(--color-accent)]" aria-hidden="true">
                        <?= e($servicio->get('icon', '✦')) ?>
                    </span>
                    <h2 class="font-serif text-lg font-semibold text-[var(--color-navy)] group-hover:text-[var(--color-burgundy)] transition-colors">
                        <?= e($servicio->trans('title', $locale) ?? '') ?>
                    </h2>
                    <?php $desc = $servicio->trans('description', $locale); ?>
                    <?php if ($desc) { ?>
                    <p class="mt-2 text-sm leading-relaxed text-[var(--color-muted)] grow">
                        <?= e($desc) ?>
                    </p>
                    <?php } else { ?>
                    <p class="mt-2 text-sm text-[var(--color-muted)] italic grow">
                        <?= e(__('general.services_info_pending')) ?>
                    </p>
                    <?php } ?>
                    <span class="mt-4 text-sm font-medium text-[var(--color-navy)] group-hover:text-[var(--color-burgundy)] transition-colors">
                        <?= e(__('general.services_see_more')) ?> →
                    </span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </section>

    <?php } ?>

    <!-- Contacto de apoyo -->
    <div class="mt-16 rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] px-8 py-8 max-w-2xl">
        <p class="text-sm text-[var(--color-muted)] mb-3">
            <?= e(__('general.services_contact_note')) ?>
        </p>
        <a
            href="<?= e(base_path('/'.$locale.'/contacto')) ?>"
            class="inline-flex items-center gap-2 text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2 focus-visible:rounded"
        >
            <?= e(__('general.services_contact_link')) ?> →
        </a>
    </div>

</main>
