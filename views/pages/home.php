<main id="main">

    <!-- 1. Hero institucional -->
    <section class="bg-[var(--color-navy)] text-[var(--color-surface)]" aria-labelledby="hero-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24 sm:py-32 text-center">
            <p class="text-xs uppercase tracking-[0.2em] text-[var(--color-gold)] mb-6 font-medium">
                <?= e(__('general.home_hero_eyebrow')) ?>
            </p>
            <h1 id="hero-title" class="text-[var(--color-surface)] mb-6">
                <?= e(__('general.site_name')) ?>
            </h1>
            <p class="text-base sm:text-lg text-[var(--color-surface)]/70 max-w-xl mx-auto leading-relaxed">
                <?= e(__('general.home_hero_subtitle')) ?>
            </p>
            <!-- CTA principal visible sin scroll -->
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a
                    href="<?= e(base_path('/'.$locale.'/servicios')) ?>"
                    class="inline-flex items-center gap-2 rounded bg-[var(--color-gold)] px-6 py-3 text-sm font-medium text-[var(--color-navy)] hover:bg-[var(--color-surface)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-white focus-visible:outline-offset-2"
                >
                    <?= e(__('general.home_cta_services')) ?>
                </a>
                <a
                    href="<?= e(base_path('/'.$locale.'/horarios')) ?>"
                    class="inline-flex items-center gap-2 rounded border border-[var(--color-surface)]/40 px-6 py-3 text-sm font-medium text-[var(--color-surface)] hover:bg-[var(--color-surface)]/10 transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-white focus-visible:outline-offset-2"
                >
                    <?= e(__('general.home_cta_schedules')) ?>
                </a>
            </div>
        </div>
    </section>

    <!-- 2. Accesos rápidos -->
    <section class="py-16 border-b border-[var(--color-border)]" aria-labelledby="quick-access-heading">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 id="quick-access-heading" class="sr-only"><?= e(__('general.home_quick_access')) ?></h2>
            <ul role="list" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <?php
                $quickLinks = [
                    ['icon' => '📅', 'label' => __('general.schedules_title'), 'href' => base_path('/'.$locale.'/horarios')],
                    ['icon' => '✦',  'label' => __('general.nav_services'),    'href' => base_path('/'.$locale.'/servicios')],
                    ['icon' => '🏛',  'label' => __('general.nav_history'),     'href' => base_path('/'.$locale.'/historia')],
                    ['icon' => '📍',  'label' => __('general.nav_visit'),       'href' => base_path('/'.$locale.'/visita')],
                ];
                foreach ($quickLinks as $ql) { ?>
                <li>
                    <a
                        href="<?= e($ql['href']) ?>"
                        class="flex items-center gap-3 rounded-lg border border-[var(--color-border)] bg-[var(--color-surface)] px-5 py-4 hover:border-[var(--color-navy)] hover:shadow-sm transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2"
                    >
                        <span aria-hidden="true" class="text-xl"><?= e($ql['icon']) ?></span>
                        <span class="text-sm font-medium text-[var(--color-navy)]"><?= e($ql['label']) ?></span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </section>

    <!-- 3. Próximas celebraciones / Horarios -->
    <section class="py-20 border-b border-[var(--color-border)]" aria-labelledby="horarios-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <?= component('ui.section-header', [
                'id' => 'horarios-title',
                'title' => __('general.home_schedules_title'),
                'subtitle' => __('general.home_schedules_subtitle'),
                'align' => 'left',
            ]) ?>

            <?php $horarios = content()->findAll('horarios', 'published') ?>

            <?php if (empty($horarios)) { ?>
                <div class="mt-8 max-w-2xl">
                    <?= component('ui.notice-banner', [
                        'message' => __('general.home_schedules_pending'),
                        'variant' => 'info',
                        'dismissible' => false,
                    ]) ?>
                </div>
            <?php } else { ?>
                <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3" role="list">
                    <?php foreach ($horarios as $horario) { ?>
                    <li>
                        <?= component('ui.card', [
                            'variant' => 'bordered',
                            'slot' => '<p class="font-medium text-[var(--color-text)]">'
                                .e($horario->trans('day', $locale ?? 'es'))
                                .'</p>'
                                .'<p class="text-sm text-[var(--color-muted)] mt-1">'
                                .e($horario->get('time', '')).'</p>',
                        ]) ?>
                    </li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <div class="mt-8">
                <a
                    href="<?= e(base_path('/'.$locale.'/horarios')) ?>"
                    class="text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2 focus-visible:rounded"
                >
                    <?= e(__('general.home_all_schedules')) ?> →
                </a>
            </div>
        </div>
    </section>

    <!-- 4. Servicios pastorales destacados -->
    <section class="py-20 bg-[var(--color-surface)] border-b border-[var(--color-border)]" aria-labelledby="servicios-home-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <?= component('ui.section-header', [
                'id' => 'servicios-home-title',
                'title' => __('general.home_services_title'),
                'subtitle' => __('general.home_services_subtitle'),
                'align' => 'left',
            ]) ?>

            <?php $servicios = array_slice(content()->findAll('servicios', '*'), 0, 4) ?>

            <?php if (! empty($servicios)) { ?>
            <ul role="list" class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($servicios as $servicio) { ?>
                <li>
                    <a
                        href="<?= e(base_path('/'.$locale.'/servicios/'.$servicio->slug)) ?>"
                        class="group flex flex-col h-full rounded-lg border border-[var(--color-border)] bg-[var(--color-background)] p-5 hover:border-[var(--color-navy)] hover:shadow-sm transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2"
                    >
                        <span class="text-xl text-[var(--color-accent)] mb-2" aria-hidden="true">
                            <?= e($servicio->get('icon', '✦')) ?>
                        </span>
                        <span class="text-sm font-semibold text-[var(--color-navy)] group-hover:text-[var(--color-burgundy)] transition-colors">
                            <?= e($servicio->trans('title', $locale ?? 'es') ?? '') ?>
                        </span>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>

            <div class="mt-8">
                <a
                    href="<?= e(base_path('/'.$locale.'/servicios')) ?>"
                    class="text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2 focus-visible:rounded"
                >
                    <?= e(__('general.home_all_services')) ?> →
                </a>
            </div>
        </div>
    </section>

    <!-- 5. Historia y patrimonio -->
    <section class="py-20 border-b border-[var(--color-border)]" aria-labelledby="historia-home-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <?= component('ui.section-header', [
                    'id' => 'historia-home-title',
                    'title' => __('general.home_history_title'),
                    'subtitle' => __('general.home_history_subtitle'),
                    'align' => 'left',
                ]) ?>
                <div class="mt-8">
                    <?= component('ui.notice-banner', [
                        'message' => __('general.home_history_pending'),
                        'variant' => 'info',
                        'dismissible' => false,
                    ]) ?>
                </div>
                <div class="mt-6">
                    <a
                        href="<?= e(base_path('/'.$locale.'/historia')) ?>"
                        class="text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2 focus-visible:rounded"
                    >
                        <?= e(__('general.home_discover_history')) ?> →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Noticias -->
    <section class="py-20 bg-[var(--color-surface)] border-b border-[var(--color-border)]" aria-labelledby="noticias-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <?= component('ui.section-header', [
                'id' => 'noticias-title',
                'title' => __('general.home_news_title'),
                'subtitle' => __('general.home_news_subtitle'),
                'align' => 'left',
            ]) ?>

            <?php $noticias = array_slice(content()->findAll('noticias', 'published'), 0, 3) ?>

            <?php if (! empty($noticias)) { ?>
            <ul role="list" class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($noticias as $noticia) { ?>
                <li>
                    <?= component('ui.card', [
                        'variant' => 'bordered',
                        'slot' => '<h3 class="font-serif text-base font-semibold text-[var(--color-navy)]">'
                            .e($noticia->trans('title', $locale ?? 'es') ?? '')
                            .'</h3>'
                            .'<a href="'.e(base_path('/'.$locale.'/noticias/'.$noticia->slug)).'" class="mt-3 inline-block text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors">'
                            .e(__('general.news_read_more')).' →</a>',
                    ]) ?>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>

            <div class="mt-8">
                <a
                    href="<?= e(base_path('/'.$locale.'/noticias')) ?>"
                    class="text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2 focus-visible:rounded"
                >
                    <?= e(__('general.home_all_news')) ?> →
                </a>
            </div>
        </div>
    </section>

    <!-- 7. Contacto -->
    <section class="py-20 border-b border-[var(--color-border)]" aria-labelledby="contacto-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 max-w-2xl">
            <?= component('ui.section-header', [
                'id' => 'contacto-title',
                'title' => __('general.home_contact_title'),
                'subtitle' => __('general.home_contact_subtitle'),
                'align' => 'left',
            ]) ?>
            <div class="mt-8">
                <?= component('ui.notice-banner', [
                    'message' => __('general.home_contact_pending'),
                    'variant' => 'info',
                    'dismissible' => false,
                ]) ?>
            </div>
            <div class="mt-6">
                <a
                    href="<?= e(base_path('/'.$locale.'/contacto')) ?>"
                    class="text-sm font-medium text-[var(--color-navy)] hover:text-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2 focus-visible:rounded"
                >
                    <?= e(__('general.contact_title')) ?> →
                </a>
            </div>
        </div>
    </section>

    <!-- 8. Preparar la visita -->
    <section class="py-20" aria-labelledby="visita-home-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)] px-8 py-12 text-center max-w-2xl mx-auto">
                <p class="text-xs uppercase tracking-widest text-[var(--color-accent)] mb-4 font-medium">
                    <?= e(__('general.home_visit_eyebrow')) ?>
                </p>
                <h2 id="visita-home-title" class="font-serif text-2xl font-semibold text-[var(--color-navy)] mb-4">
                    <?= e(__('general.home_visit_title')) ?>
                </h2>
                <p class="text-sm leading-relaxed text-[var(--color-muted)] mb-8">
                    <?= e(__('general.home_visit_subtitle')) ?>
                </p>
                <a
                    href="<?= e(base_path('/'.$locale.'/visita')) ?>"
                    class="inline-flex items-center gap-2 rounded bg-[var(--color-navy)] px-6 py-3 text-sm font-medium text-white hover:bg-[var(--color-burgundy)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-[var(--color-navy)] focus-visible:outline-offset-2"
                >
                    <?= e(__('general.home_visit_btn')) ?>
                </a>
            </div>
        </div>
    </section>

</main>
