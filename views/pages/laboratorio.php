<main id="main" class="mx-auto max-w-7xl px-6 py-16 space-y-24">

    <header class="border-b border-[--color-border] pb-8">
        <?= component('ui.breadcrumbs', ['items' => [
            ['label' => 'Inicio', 'href' => '/'],
            ['label' => 'Laboratorio'],
        ]]) ?>
        <p class="text-xs uppercase tracking-widest text-[--color-muted] mb-3 mt-6">Design Lab · Fase 1–2</p>
        <h1>Laboratorio de diseño</h1>
        <p class="mt-4 text-lg text-[--color-muted] max-w-2xl">
            Verificación de tokens visuales y componentes de interfaz. No visible en producción.
        </p>
    </header>

    <!-- ================================================
         TIPOGRAFÍA
         ================================================ -->
    <?= component('ui.section-header', ['eyebrow' => 'Tokens', 'title' => 'Tipografía']) ?>

    <section class="space-y-6 -mt-16">
        <div>
            <p class="text-xs text-[--color-muted] mb-1">h1 · Playfair Display · clamp(2rem→3.25rem)</p>
            <h1>Parroquia Castrense de Santa Margarita</h1>
        </div>
        <div>
            <p class="text-xs text-[--color-muted] mb-1">h2 · Playfair Display · clamp(1.5rem→2.5rem)</p>
            <h2>Historia y misión pastoral</h2>
        </div>
        <div>
            <p class="text-xs text-[--color-muted] mb-1">h3 · Playfair Display</p>
            <h3>Próximas celebraciones litúrgicas</h3>
        </div>
        <div>
            <p class="text-xs text-[--color-muted] mb-1">h4 · Inter</p>
            <h4>Avisos de la comunidad</h4>
        </div>
        <div>
            <p class="text-xs text-[--color-muted] mb-1">Cuerpo · Inter 16px/1.6</p>
            <p class="max-w-prose">
                La parroquia castrense acompaña a la comunidad militar y a sus familias
                en su vida espiritual y pastoral. La fe, el servicio y la tradición son
                los pilares que guían nuestra misión en el corazón de Mallorca.
            </p>
        </div>
        <div>
            <p class="text-xs text-[--color-muted] mb-1">Itálica serif</p>
            <p class="italic font-serif text-xl text-[--color-navy]">"Pacem relinquo vobis, pacem meam do vobis"</p>
        </div>
    </section>

    <!-- ================================================
         PALETA DE COLORES
         ================================================ -->
    <?= component('ui.section-header', ['eyebrow' => 'Tokens', 'title' => 'Paleta de colores']) ?>

    <section class="-mt-16">
        <?php
        $swatches = [
            ['bg-[--color-background]',  '#F5F1E8', 'background',  'Fondo principal',       'text-[--color-text]'],
            ['bg-[--color-surface]',     '#FFFDF8', 'surface',      'Superficie / card',     'text-[--color-text]'],
            ['bg-[--color-text]',        '#1F2529', 'text',         'Texto principal',        'text-[--color-surface]'],
            ['bg-[--color-muted]',       '#666A68', 'muted',        'Texto secundario',       'text-[--color-surface]'],
            ['bg-[--color-navy]',        '#172734', 'navy',         'Marino institucional',   'text-[--color-surface]'],
            ['bg-[--color-burgundy]',    '#6F2638', 'burgundy',     'Burdeos litúrgico',      'text-[--color-surface]'],
            ['bg-[--color-gold]',        '#A7864B', 'gold',         'Oro ornamental',         'text-[--color-surface]'],
            ['bg-[--color-olive]',       '#69705A', 'olive',        'Oliva mediterráneo',     'text-[--color-surface]'],
            ['bg-[--color-border]',      '#D8D0C2', 'border',       'Borde / separador',      'text-[--color-text]'],
            ['bg-[--color-error]',       '#9F2F2F', 'error',        'Error / alerta',         'text-[--color-surface]'],
            ['bg-[--color-success]',     '#3E684E', 'success',      'Éxito / confirmación',   'text-[--color-surface]'],
        ];
        ?>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-12">
            <?php foreach ($swatches as [$bg, $hex, $token, $label, $text]) { ?>
            <div class="rounded-lg overflow-hidden border border-[--color-border] shadow-sm">
                <div class="<?= e($bg) ?> h-20 flex items-end p-3">
                    <span class="<?= e($text) ?> text-xs font-mono"><?= e($hex) ?></span>
                </div>
                <div class="bg-[--color-surface] p-3">
                    <p class="text-xs font-mono text-[--color-muted]">--color-<?= e($token) ?></p>
                    <p class="text-sm font-medium text-[--color-text]"><?= e($label) ?></p>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="border-b border-[--color-border]">
                        <th class="text-left py-2 pr-4 text-[--color-muted] font-medium">Combinación</th>
                        <th class="text-left py-2 pr-4 text-[--color-muted] font-medium">Vista</th>
                        <th class="text-left py-2 pr-4 text-[--color-muted] font-medium">Ratio</th>
                        <th class="text-left py-2 pr-4 text-[--color-muted] font-medium">Norma AA</th>
                        <th class="text-left py-2 text-[--color-muted] font-medium">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[--color-border]">
                    <?php
                    $contrasts = [
                        ['text-[--color-text] bg-[--color-background]',  'Texto / Fondo',      '12.1:1', 'Normal 4.5:1', true],
                        ['text-[--color-text] bg-[--color-surface]',     'Texto / Superficie', '13.8:1', 'Normal 4.5:1', true],
                        ['text-[--color-surface] bg-[--color-navy]',     'Blanco / Navy',      '14.3:1', 'Normal 4.5:1', true],
                        ['text-[--color-surface] bg-[--color-burgundy]', 'Blanco / Burdeos',    '7.5:1', 'Normal 4.5:1', true],
                        ['text-[--color-surface] bg-[--color-gold]',     'Blanco / Oro',        '2.9:1', 'Solo grande',  false],
                        ['text-[--color-text] bg-[--color-gold]',        'Texto / Oro',         '4.8:1', 'Normal 4.5:1', true],
                        ['text-[--color-surface] bg-[--color-olive]',    'Blanco / Oliva',      '4.6:1', 'Normal 4.5:1', true],
                        ['text-[--color-surface] bg-[--color-error]',    'Blanco / Error',      '7.9:1', 'Normal 4.5:1', true],
                        ['text-[--color-muted] bg-[--color-background]', 'Muted / Fondo',       '4.6:1', 'Normal 4.5:1', true],
                    ];
        foreach ($contrasts as [$classes, $label, $ratio, $standard, $pass]) {
            ?>
                    <tr>
                        <td class="py-2 pr-4 text-xs text-[--color-muted]"><?= e($label) ?></td>
                        <td class="py-2 pr-4"><span class="<?= e($classes) ?> px-3 py-1 text-sm rounded">Aa</span></td>
                        <td class="py-2 pr-4 font-mono text-sm"><?= e($ratio) ?></td>
                        <td class="py-2 pr-4 text-xs text-[--color-muted]"><?= e($standard) ?></td>
                        <td class="py-2">
                            <?php if ($pass) { ?>
                                <span class="text-[--color-success] font-medium text-xs">✓ Pasa</span>
                            <?php } else { ?>
                                <span class="text-[--color-error] font-medium text-xs">✗ Falla</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- ================================================
         COMPONENTES
         ================================================ -->
    <?= component('ui.section-header', ['eyebrow' => 'Fase 2', 'title' => 'Componentes de interfaz']) ?>

    <!-- Button -->
    <section class="-mt-16 space-y-6">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">Button</h3>
        <div class="flex flex-wrap gap-3 items-center">
            <?= component('ui.button', ['label' => 'Primario',   'variant' => 'primary']) ?>
            <?= component('ui.button', ['label' => 'Secundario', 'variant' => 'secondary']) ?>
            <?= component('ui.button', ['label' => 'Ghost',      'variant' => 'ghost']) ?>
            <?= component('ui.button', ['label' => 'Peligro',    'variant' => 'danger']) ?>
            <?= component('ui.button', ['label' => 'Desactivado', 'disabled' => true]) ?>
        </div>
        <div class="flex flex-wrap gap-3 items-center">
            <?= component('ui.button', ['label' => 'Pequeño', 'size' => 'sm']) ?>
            <?= component('ui.button', ['label' => 'Base', 'size' => 'base']) ?>
            <?= component('ui.button', ['label' => 'Grande', 'size' => 'lg']) ?>
            <?= component('ui.button', ['label' => 'Enlace →', 'tag' => 'a', 'href' => '#', 'variant' => 'secondary']) ?>
        </div>
    </section>

    <!-- Card -->
    <section class="space-y-6">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">Card</h3>
        <div class="grid sm:grid-cols-3 gap-6">
            <?= component('ui.card', [
                'variant' => 'default',
                'slot' => '<p class="text-xs text-[--color-muted] mb-2 uppercase tracking-widest">default</p><p class="font-serif text-lg">Variante por defecto</p>',
            ]) ?>
            <?= component('ui.card', [
                'variant' => 'bordered',
                'slot' => '<p class="text-xs text-[--color-muted] mb-2 uppercase tracking-widest">bordered</p><p class="font-serif text-lg">Con borde</p>',
            ]) ?>
            <?= component('ui.card', [
                'variant' => 'elevated',
                'slot' => '<p class="text-xs text-[--color-muted] mb-2 uppercase tracking-widest">elevated</p><p class="font-serif text-lg">Con sombra</p>',
            ]) ?>
        </div>
    </section>

    <!-- SectionHeader -->
    <section class="space-y-6">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">SectionHeader</h3>
        <div class="border border-[--color-border] rounded-lg p-8">
            <?= component('ui.section-header', [
                'eyebrow' => 'Historia · 1898',
                'title' => 'La parroquia y su patrimonio',
                'subtitle' => 'Un recorrido por la arquitectura y la memoria de la institución castrense en Mallorca.',
                'align' => 'center',
            ]) ?>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <section class="space-y-4">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">Breadcrumbs</h3>
        <?= component('ui.breadcrumbs', ['items' => [
            ['label' => 'Inicio', 'href' => '/'],
            ['label' => 'Historia', 'href' => '/historia'],
            ['label' => 'Patrimonio'],
        ]]) ?>
    </section>

    <!-- Accordion -->
    <section class="space-y-4">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">Accordion</h3>
        <?= component('ui.accordion', ['items' => [
            ['title' => '¿Cuándo se celebra la misa dominical?', 'content' => 'Horario pendiente de confirmación por la parroquia. <em>[DEMO]</em>'],
            ['title' => '¿Cómo puedo solicitar un sacramento?', 'content' => 'Contacta con la parroquia por los medios disponibles en la página de contacto.'],
            ['title' => '¿La parroquia ofrece catequesis?', 'content' => 'Información pendiente de confirmar. <em>[DEMO]</em>'],
        ], 'id' => 'faq-demo']) ?>
    </section>

    <!-- NoticeBanner -->
    <section class="space-y-4">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">NoticeBanner</h3>
        <?= component('ui.notice-banner', ['variant' => 'info',    'message' => 'Información general para la comunidad.']) ?>
        <?= component('ui.notice-banner', ['variant' => 'warning', 'message' => 'Aviso de cambio de horario. <strong>Comprueba la web antes de asistir.</strong>']) ?>
        <?= component('ui.notice-banner', ['variant' => 'success', 'message' => 'Tu solicitud ha sido recibida correctamente.']) ?>
        <?= component('ui.notice-banner', ['variant' => 'error',   'message' => 'Se ha producido un error. Inténtalo más tarde.']) ?>
        <?= component('ui.notice-banner', ['variant' => 'info',    'message' => 'Este aviso se puede cerrar.', 'dismissible' => true]) ?>
    </section>

    <!-- FormField -->
    <section class="space-y-6">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">FormField</h3>
        <div class="max-w-lg space-y-5">
            <?= component('ui.form-field', ['name' => 'nombre',  'label' => 'Nombre completo', 'type' => 'text',     'required' => true, 'placeholder' => 'Tu nombre']) ?>
            <?= component('ui.form-field', ['name' => 'email',   'label' => 'Correo electrónico', 'type' => 'email', 'required' => true, 'hint' => 'Nunca compartiremos tu correo.']) ?>
            <?= component('ui.form-field', ['name' => 'asunto',  'label' => 'Asunto', 'type' => 'select', 'placeholder' => 'Selecciona…', 'options' => ['sacramento' => 'Sacramento', 'informacion' => 'Información general', 'otro' => 'Otro']]) ?>
            <?= component('ui.form-field', ['name' => 'mensaje', 'label' => 'Mensaje', 'type' => 'textarea', 'required' => true, 'rows' => 5]) ?>
            <?= component('ui.form-field', ['name' => 'telefono', 'label' => 'Teléfono', 'type' => 'tel', 'error' => 'Formato inválido. Usa solo números y el prefijo internacional.']) ?>
        </div>
    </section>

    <!-- SkipLink -->
    <section class="space-y-4">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">SkipLink</h3>
        <p class="text-sm text-[--color-muted]">El skip-link está activo en esta página (arriba izquierda). Pulsa Tab para verlo.</p>
    </section>

    <!-- ================================================
         RESPONSIVE
         ================================================ -->
    <section class="space-y-4">
        <h3 class="text-xs uppercase tracking-widest text-[--color-muted]">Breakpoints responsive</h3>
        <div class="inline-flex gap-2 rounded-lg border border-[--color-border] p-3">
            <span class="sm:hidden            px-2 py-1 bg-[--color-burgundy] text-[--color-surface] rounded text-xs font-mono">xs &lt;640px</span>
            <span class="hidden sm:inline-block md:hidden  px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">sm 640px</span>
            <span class="hidden md:inline-block lg:hidden  px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">md 768px</span>
            <span class="hidden lg:inline-block xl:hidden  px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">lg 1024px</span>
            <span class="hidden xl:inline-block 2xl:hidden px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">xl 1280px</span>
            <span class="hidden 2xl:inline-block           px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">2xl 1440px</span>
        </div>
    </section>

</main>
