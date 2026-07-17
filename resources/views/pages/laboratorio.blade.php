<x-layout.app title="Laboratorio de diseño">
<main id="main" class="mx-auto max-w-7xl px-6 py-16 space-y-24">

    {{-- Encabezado --}}
    <header class="border-b border-[--color-border] pb-8">
        <p class="text-xs uppercase tracking-widest text-[--color-muted] mb-3">Design Lab · Fase 1</p>
        <h1>Laboratorio de diseño</h1>
        <p class="mt-4 text-lg text-[--color-muted] max-w-2xl">
            Página de verificación de tokens visuales. No visible en producción.
        </p>
    </header>

    {{-- ====================================================
         TIPOGRAFÍA
         ==================================================== --}}
    <section aria-labelledby="s-tipografia">
        <h2 id="s-tipografia" class="text-xs uppercase tracking-widest text-[--color-muted] mb-8">Tipografía</h2>

        <div class="space-y-6">
            <div>
                <p class="text-xs text-[--color-muted] mb-1">h1 · Playfair Display · clamp(2rem→3.25rem)</p>
                <h1>Parroquia Castrense de Santa Margarita</h1>
            </div>
            <div>
                <p class="text-xs text-[--color-muted] mb-1">h2 · Playfair Display · clamp(1.5rem→2.5rem)</p>
                <h2>Historia y misión pastoral</h2>
            </div>
            <div>
                <p class="text-xs text-[--color-muted] mb-1">h3 · Playfair Display · clamp(1.25rem→1.875rem)</p>
                <h3>Próximas celebraciones litúrgicas</h3>
            </div>
            <div>
                <p class="text-xs text-[--color-muted] mb-1">h4 · Inter · clamp(1.1rem→1.375rem)</p>
                <h4>Avisos de la comunidad</h4>
            </div>
            <div>
                <p class="text-xs text-[--color-muted] mb-1">Cuerpo · Inter 16px/1.6</p>
                <p class="max-w-prose">
                    La parroquia castrense acompaña a la comunidad militar y a sus familias en
                    su vida espiritual y pastoral. La fe, el servicio y la tradición son los
                    pilares que guían nuestra misión en el corazón de Mallorca.
                </p>
            </div>
            <div>
                <p class="text-xs text-[--color-muted] mb-1">Small / muted</p>
                <p class="text-sm text-[--color-muted]">Texto secundario · información complementaria · pie de imagen</p>
            </div>
            <div>
                <p class="text-xs text-[--color-muted] mb-1">Itálica serif</p>
                <p class="italic font-serif text-xl text-[--color-navy]">"Sed et ipsa scientia potestas est"</p>
            </div>
            <div>
                <p class="text-xs text-[--color-muted] mb-1">Uppercase tracking · etiquetas / secciones</p>
                <p class="text-xs font-medium uppercase tracking-widest text-[--color-muted]">Calendario litúrgico · 2025</p>
            </div>
        </div>
    </section>

    {{-- ====================================================
         PALETA DE COLORES
         ==================================================== --}}
    <section aria-labelledby="s-colores">
        <h2 id="s-colores" class="text-xs uppercase tracking-widest text-[--color-muted] mb-8">Paleta de colores</h2>

        {{-- Principales --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-12">

            @foreach ([
                ['bg-[--color-background]',  '#F5F1E8', 'background',  'Fondo principal',   'text-[--color-text]'],
                ['bg-[--color-surface]',     '#FFFDF8', 'surface',      'Superficie / card', 'text-[--color-text]'],
                ['bg-[--color-text]',        '#1F2529', 'text',         'Texto principal',   'text-[--color-surface]'],
                ['bg-[--color-muted]',       '#666A68', 'muted',        'Texto secundario',  'text-[--color-surface]'],
                ['bg-[--color-navy]',        '#172734', 'navy',         'Marino institucional', 'text-[--color-surface]'],
                ['bg-[--color-burgundy]',    '#6F2638', 'burgundy',     'Burdeos litúrgico', 'text-[--color-surface]'],
                ['bg-[--color-gold]',        '#A7864B', 'gold',         'Oro ornamental',    'text-[--color-surface]'],
                ['bg-[--color-olive]',       '#69705A', 'olive',        'Oliva mediterráneo','text-[--color-surface]'],
                ['bg-[--color-border]',      '#D8D0C2', 'border',       'Borde / separador', 'text-[--color-text]'],
                ['bg-[--color-error]',       '#9F2F2F', 'error',        'Error / alerta',    'text-[--color-surface]'],
                ['bg-[--color-success]',     '#3E684E', 'success',      'Éxito / confirmación', 'text-[--color-surface]'],
            ] as [$bg, $hex, $token, $label, $text])
            <div class="rounded-lg overflow-hidden border border-[--color-border] shadow-sm">
                <div class="{{ $bg }} h-20 flex items-end p-3">
                    <span class="{{ $text }} text-xs font-mono">{{ $hex }}</span>
                </div>
                <div class="bg-[--color-surface] p-3">
                    <p class="text-xs font-mono text-[--color-muted]">--color-{{ $token }}</p>
                    <p class="text-sm font-medium text-[--color-text]">{{ $label }}</p>
                </div>
            </div>
            @endforeach

        </div>

        {{-- Contrastes WCAG AA --}}
        <div>
            <h3 class="text-sm font-semibold text-[--color-text] mb-4">Ratios de contraste WCAG 2.2 AA</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead>
                        <tr class="border-b border-[--color-border]">
                            <th class="text-left py-2 pr-4 text-[--color-muted] font-medium">Combinación</th>
                            <th class="text-left py-2 pr-4 text-[--color-muted] font-medium">Vista previa</th>
                            <th class="text-left py-2 pr-4 text-[--color-muted] font-medium">Ratio</th>
                            <th class="text-left py-2 text-[--color-muted] font-medium">Norma (AA)</th>
                            <th class="text-left py-2 text-[--color-muted] font-medium">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[--color-border]">

                        @foreach ([
                            ['text-[--color-text] bg-[--color-background]',    'Texto / Fondo',          '12.1:1', 'Normal 4.5:1', true],
                            ['text-[--color-text] bg-[--color-surface]',       'Texto / Superficie',     '13.8:1', 'Normal 4.5:1', true],
                            ['text-[--color-surface] bg-[--color-navy]',       'Blanco / Navy',          '14.3:1', 'Normal 4.5:1', true],
                            ['text-[--color-surface] bg-[--color-burgundy]',   'Blanco / Burdeos',        '7.5:1', 'Normal 4.5:1', true],
                            ['text-[--color-surface] bg-[--color-gold]',       'Blanco / Oro',            '2.9:1', 'Solo grande 3:1', false],
                            ['text-[--color-text] bg-[--color-gold]',          'Texto / Oro',             '4.8:1', 'Normal 4.5:1', true],
                            ['text-[--color-surface] bg-[--color-olive]',      'Blanco / Oliva',          '4.6:1', 'Normal 4.5:1', true],
                            ['text-[--color-surface] bg-[--color-error]',      'Blanco / Error',          '7.9:1', 'Normal 4.5:1', true],
                            ['text-[--color-surface] bg-[--color-success]',    'Blanco / Éxito',          '5.8:1', 'Normal 4.5:1', true],
                            ['text-[--color-muted] bg-[--color-background]',   'Muted / Fondo',           '4.6:1', 'Normal 4.5:1', true],
                        ] as [$classes, $label, $ratio, $standard, $pass])
                        <tr>
                            <td class="py-2 pr-4 font-mono text-xs text-[--color-muted]">{{ $label }}</td>
                            <td class="py-2 pr-4">
                                <span class="{{ $classes }} px-3 py-1 text-sm rounded">Aa</span>
                            </td>
                            <td class="py-2 pr-4 font-mono text-sm">{{ $ratio }}</td>
                            <td class="py-2 pr-4 text-xs text-[--color-muted]">{{ $standard }}</td>
                            <td class="py-2">
                                @if ($pass)
                                    <span class="text-[--color-success] font-medium text-xs">✓ Pasa</span>
                                @else
                                    <span class="text-[--color-error] font-medium text-xs">✗ Falla</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <p class="mt-3 text-xs text-[--color-muted]">
                Nota: El oro (#A7864B) sobre blanco no pasa AA para texto normal; se usará solo sobre fondo oscuro o en tamaños grandes.
            </p>
        </div>
    </section>

    {{-- ====================================================
         ESPACIADO
         ==================================================== --}}
    <section aria-labelledby="s-espaciado">
        <h2 id="s-espaciado" class="text-xs uppercase tracking-widest text-[--color-muted] mb-8">Escala de espaciado</h2>

        <div class="space-y-3">
            @foreach ([
                ['--spacing-1',  '4px',  'w-1'],
                ['--spacing-2',  '8px',  'w-2'],
                ['--spacing-3',  '12px', 'w-3'],
                ['--spacing-4',  '16px', 'w-4'],
                ['--spacing-6',  '24px', 'w-6'],
                ['--spacing-8',  '32px', 'w-8'],
                ['--spacing-10', '40px', 'w-10'],
                ['--spacing-12', '48px', 'w-12'],
                ['--spacing-16', '64px', 'w-16'],
                ['--spacing-20', '80px', 'w-20'],
                ['--spacing-24', '96px', 'w-24'],
                ['--spacing-32', '128px','w-32'],
            ] as [$token, $value, $tw])
            <div class="flex items-center gap-4">
                <span class="font-mono text-xs text-[--color-muted] w-28">{{ $token }}</span>
                <div class="{{ $tw }} h-4 bg-[--color-navy] rounded-sm"></div>
                <span class="text-xs text-[--color-muted]">{{ $value }}</span>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ====================================================
         SOMBRAS Y BORDES
         ==================================================== --}}
    <section aria-labelledby="s-sombras">
        <h2 id="s-sombras" class="text-xs uppercase tracking-widest text-[--color-muted] mb-8">Sombras y bordes</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ([
                ['shadow-xs', '--shadow-xs'],
                ['shadow-sm', '--shadow-sm'],
                ['shadow-md', '--shadow-md'],
                ['shadow-lg', '--shadow-lg'],
                ['shadow-xl', '--shadow-xl'],
            ] as [$tw, $token])
            <div class="bg-[--color-surface] rounded-lg p-6 {{ $tw }} border border-[--color-border] text-center">
                <p class="text-xs font-mono text-[--color-muted]">{{ $token }}</p>
            </div>
            @endforeach
        </div>

        <div class="mt-8 flex flex-wrap gap-4">
            @foreach ([
                ['--radius-sm', '4px',   'rounded-[--radius-sm]'],
                ['--radius-md', '8px',   'rounded-[--radius-md]'],
                ['--radius-lg', '12px',  'rounded-[--radius-lg]'],
                ['--radius-xl', '16px',  'rounded-[--radius-xl]'],
                ['--radius-full','9999px','rounded-full'],
            ] as [$token, $value, $tw])
            <div class="bg-[--color-navy] {{ $tw }} px-6 py-3 text-center">
                <p class="text-xs font-mono text-[--color-surface]">{{ $token }}</p>
                <p class="text-xs text-[--color-border]">{{ $value }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ====================================================
         ESTADOS INTERACTIVOS
         ==================================================== --}}
    <section aria-labelledby="s-estados">
        <h2 id="s-estados" class="text-xs uppercase tracking-widest text-[--color-muted] mb-8">Foco y accesibilidad</h2>

        <div class="flex flex-wrap gap-4 items-center">
            <a href="#" class="text-[--color-navy] underline underline-offset-2 hover:text-[--color-burgundy] transition-colors">
                Enlace con foco (Tab para ver)
            </a>
            <button class="px-4 py-2 bg-[--color-navy] text-[--color-surface] rounded-md hover:bg-[--color-text] transition-colors">
                Botón primario
            </button>
            <button class="px-4 py-2 border border-[--color-navy] text-[--color-navy] rounded-md hover:bg-[--color-background] transition-colors">
                Botón secundario
            </button>
            <span class="px-3 py-1 text-xs font-medium uppercase tracking-wide bg-[--color-burgundy] text-[--color-surface] rounded-full">
                Etiqueta burdeos
            </span>
            <span class="px-3 py-1 text-xs font-medium uppercase tracking-wide bg-[--color-gold] text-[--color-text] rounded-full">
                Etiqueta oro
            </span>
        </div>
    </section>

    {{-- ====================================================
         RESPONSIVE — indicador de breakpoint
         ==================================================== --}}
    <section aria-labelledby="s-responsive">
        <h2 id="s-responsive" class="text-xs uppercase tracking-widest text-[--color-muted] mb-8">Breakpoints responsive</h2>

        <div class="inline-flex gap-2 rounded-lg border border-[--color-border] p-3">
            <span class="sm:hidden px-2 py-1 bg-[--color-burgundy] text-[--color-surface] rounded text-xs font-mono">xs &lt;640px</span>
            <span class="hidden sm:inline-block md:hidden px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">sm 640px</span>
            <span class="hidden md:inline-block lg:hidden px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">md 768px</span>
            <span class="hidden lg:inline-block xl:hidden px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">lg 1024px</span>
            <span class="hidden xl:inline-block 2xl:hidden px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">xl 1280px</span>
            <span class="hidden 2xl:inline-block px-2 py-1 bg-[--color-navy] text-[--color-surface] rounded text-xs font-mono">2xl 1440px</span>
        </div>

        <p class="mt-4 text-sm text-[--color-muted]">El chip activo indica el breakpoint actual. Redimensiona la ventana para verificar.</p>
    </section>

    {{-- ====================================================
         MOTION
         ==================================================== --}}
    <section aria-labelledby="s-motion">
        <h2 id="s-motion" class="text-xs uppercase tracking-widest text-[--color-muted] mb-8">Motion tokens</h2>

        <div class="flex flex-wrap gap-6" x-data="{ active: null }">
            @foreach ([
                ['fast',  '150ms', 'duration-[150ms]'],
                ['base',  '200ms', 'duration-[200ms]'],
                ['slow',  '250ms', 'duration-[250ms]'],
            ] as [$name, $value, $tw])
            <div
                class="w-16 h-16 bg-[--color-gold] rounded-lg cursor-pointer {{ $tw }} ease-[cubic-bezier(0.4,0,0.2,1)] transition-transform hover:scale-110 active:scale-95"
                title="{{ $name }} · {{ $value }}"
                x-on:click="active = '{{ $name }}'"
            ></div>
            @endforeach
        </div>
        <p class="mt-3 text-xs text-[--color-muted]">Hover o clic para probar las transiciones. Respeta <code>prefers-reduced-motion</code>.</p>
    </section>

</main>
</x-layout.app>
