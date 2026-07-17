<?php
/**
 * Footer
 *
 * Props:
 *   $locale  string  Locale activo  ['es']
 *   $year    int     Año copyright  [año actual]
 */
$locale = $locale ?? 'es';
$year = $year ?? (int) date('Y');

$navLinks = [
    ['label' => __('general.nav_home'),        'href' => base_path('/'.$locale.'/')],
    ['label' => __('general.about_title'),     'href' => base_path('/'.$locale.'/sobre')],
    ['label' => __('general.news_title'),      'href' => base_path('/'.$locale.'/noticias')],
    ['label' => __('general.schedules_title'), 'href' => base_path('/'.$locale.'/horarios')],
    ['label' => __('general.contact_title'),   'href' => base_path('/'.$locale.'/contacto')],
];
?>
<footer class="mt-24 border-t border-[--color-border] bg-[--color-surface]" role="contentinfo">
    <div class="mx-auto max-w-7xl px-6 py-12 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">

        <!-- Identidad -->
        <div>
            <p class="text-xs uppercase tracking-widest text-[--color-muted] font-semibold mb-2">
                <?= e(__('general.site_name')) ?>
            </p>
            <p class="text-xs text-[--color-muted] leading-relaxed max-w-xs">
                <?= e(__('general.footer_tagline')) ?>
            </p>
        </div>

        <!-- Navegación -->
        <nav aria-label="<?= e(__('general.footer_nav')) ?>">
            <p class="text-xs uppercase tracking-widest text-[--color-muted] font-semibold mb-2">
                <?= e(__('general.nav_main')) ?>
            </p>
            <ul class="flex flex-col gap-1.5">
                <?php foreach ($navLinks as $link) { ?>
                <li>
                    <a
                        href="<?= e($link['href']) ?>"
                        class="text-xs text-[--color-muted] hover:text-[--color-text] transition-colors"
                    >
                        <?= e($link['label']) ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>

        <!-- Copyright y legal -->
        <div class="sm:col-span-2 lg:col-span-1">
            <p class="text-xs text-[--color-muted] mb-3">
                &copy; <?= $year ?> <?= e(__('general.site_name')) ?><br>
                <?= e(__('general.footer_rights')) ?>
            </p>
            <ul class="flex flex-wrap gap-x-4 gap-y-1">
                <li>
                    <a href="<?= e(base_path('/'.$locale.'/aviso-legal')) ?>" class="text-xs text-[--color-muted] hover:text-[--color-text] transition-colors">
                        <?= e(__('general.footer_legal')) ?>
                    </a>
                </li>
                <li>
                    <a href="<?= e(base_path('/'.$locale.'/privacidad')) ?>" class="text-xs text-[--color-muted] hover:text-[--color-text] transition-colors">
                        <?= e(__('general.footer_privacy')) ?>
                    </a>
                </li>
                <li>
                    <a href="<?= e(base_path('/'.$locale.'/accesibilidad')) ?>" class="text-xs text-[--color-muted] hover:text-[--color-text] transition-colors">
                        <?= e(__('general.footer_accessibility')) ?>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</footer>
