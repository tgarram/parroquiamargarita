<main id="main">

    <!-- Hero -->
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
        </div>
    </section>

    <!-- Horarios -->
    <section class="py-20 border-b border-[var(--color-border)]" aria-labelledby="horarios-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <?= component('ui.section-header', [
                'id' => 'horarios-title',
                'eyebrow' => null,
                'title' => __('general.home_schedules_title'),
                'subtitle' => __('general.home_schedules_subtitle'),
                'align' => 'left',
            ]) ?>

            <?php $horarios = content()->findAll('horarios', 'published') ?>

            <?php if (empty($horarios)) { ?>
                <div class="mt-8">
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
        </div>
    </section>

    <!-- Noticias -->
    <section class="py-20 bg-[var(--color-surface)] border-b border-[var(--color-border)]" aria-labelledby="noticias-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <?= component('ui.section-header', [
                'id' => 'noticias-title',
                'eyebrow' => null,
                'title' => __('general.home_news_title'),
                'subtitle' => __('general.home_news_subtitle'),
                'align' => 'left',
            ]) ?>

            <?php $noticias = content()->findAll('noticias', 'published') ?>

            <?php if (empty($noticias)) { ?>
                <div class="mt-8">
                    <?= component('ui.notice-banner', [
                        'message' => __('general.home_news_subtitle'),
                        'variant' => 'info',
                        'dismissible' => false,
                    ]) ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Contacto -->
    <section class="py-20" aria-labelledby="contacto-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <?= component('ui.section-header', [
                'id' => 'contacto-title',
                'eyebrow' => null,
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
        </div>
    </section>

</main>
