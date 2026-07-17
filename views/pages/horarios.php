<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __('general.schedules_title')],
        ],
    ]) ?>

    <?= component('ui.section-header', [
        'id' => 'horarios-title',
        'title' => __('general.schedules_title'),
        'subtitle' => __('general.schedules_subtitle'),
        'align' => 'left',
    ]) ?>

    <?php if (empty($horarios)) { ?>

        <div class="mt-8 max-w-2xl">
            <?= component('ui.notice-banner', [
                'message' => __('general.schedules_pending'),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>

    <?php } else { ?>

        <div class="mt-10 overflow-x-auto rounded-lg border border-[var(--color-border)]">
            <table class="w-full text-sm" aria-labelledby="horarios-title">
                <thead class="bg-[var(--color-surface)] border-b border-[var(--color-border)]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-widest text-[var(--color-muted)]">
                            <?= e(__('general.schedules_day')) ?>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-widest text-[var(--color-muted)]">
                            <?= e(__('general.schedules_time')) ?>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-widest text-[var(--color-muted)]">
                            <?= e(__('general.schedules_location')) ?>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-widest text-[var(--color-muted)]">
                            <?= e(__('general.schedules_notes')) ?>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--color-border)] bg-[var(--color-background)]">
                    <?php foreach ($horarios as $horario) { ?>
                    <tr class="hover:bg-[var(--color-surface)] transition-colors">
                        <td class="px-6 py-4 font-medium text-[var(--color-text)]">
                            <?= e($horario->trans('day', $locale)) ?>
                        </td>
                        <td class="px-6 py-4 text-[var(--color-text)]">
                            <?= e($horario->get('time') ?? '—') ?>
                        </td>
                        <td class="px-6 py-4 text-[var(--color-muted)]">
                            <?= e($horario->trans('location', $locale) ?? '—') ?>
                        </td>
                        <td class="px-6 py-4 text-[var(--color-muted)]">
                            <?= e($horario->trans('notes', $locale) ?? '') ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    <?php } ?>

</main>
