<?php
/**
 * Vista genérica para páginas de contenido simple (legal, privacidad, accesibilidad).
 *
 * Props:
 *   $page        ContentItem|null   El item de contenido
 *   $titleKey    string             Clave i18n del título
 *   $subtitleKey string             Clave i18n del subtítulo
 *   $pendingKey  string             Clave i18n del aviso pending
 *   $headingId   string             ID del h1 para aria-labelledby
 *   $locale      string
 */
?>
<main id="main" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">

    <?= component('ui.breadcrumbs', [
        'items' => [
            ['label' => __('general.nav_home'), 'href' => base_path('/'.$locale.'/')],
            ['label' => __($titleKey)],
        ],
    ]) ?>

    <?= component('ui.section-header', [
        'id' => $headingId,
        'title' => __($titleKey),
        'subtitle' => __($subtitleKey),
        'align' => 'left',
    ]) ?>

    <?php if ($page === null || ! $page->isPublished()) { ?>

        <div class="mt-8 max-w-2xl">
            <?= component('ui.notice-banner', [
                'message' => __($pendingKey),
                'variant' => 'info',
                'dismissible' => false,
            ]) ?>
        </div>

    <?php } else { ?>

        <article
            aria-labelledby="<?= e($headingId) ?>"
            class="mt-10 max-w-prose leading-relaxed text-[var(--color-text)]"
        >
            <?= nl2br(e($page->trans('body', $locale))) ?>
        </article>

    <?php } ?>

</main>
