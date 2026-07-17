# Arquitectura técnica

**Proyecto:** Web Parroquia Castrense de Santa Margarita de Mallorca
**Stack:** PHP 8.3+ puro · Tailwind CSS v4 · Alpine.js · Vite
**Despliegue:** Sitio estático en GitHub Pages vía `bin/build-static.php`

---

## Estructura del repositorio

```
/
├── bin/
│   └── build-static.php     # Generador de sitio estático
├── config/                  # Configuración de la app (app, content, vite)
├── content/
│   ├── noticias/            # Artículos de noticias
│   ├── horarios/            # Entradas de horario litúrgico
│   ├── historia/            # Entradas de línea de tiempo histórica
│   ├── servicios/           # Servicios pastorales
│   └── paginas/             # Páginas estáticas (contacto, visita, etc.)
├── docs/
│   ├── adr/                 # Architecture Decision Records
│   ├── architecture.md      # Este archivo
│   ├── content-governance.md
│   └── sdd-workflow.md
├── lang/
│   ├── es/                  # Español (idioma por defecto)
│   ├── ca/                  # Catalán de Mallorca
│   └── en/                  # Inglés
├── public/
│   ├── index.php            # Punto de entrada del servidor PHP
│   ├── build/               # Assets compilados (Vite, gitignored)
│   └── robots.txt
├── resources/
│   ├── css/app.css          # Design tokens + estilos globales (Tailwind v4)
│   └── js/app.js            # Alpine.js bootstrap
├── routes/
│   ├── web.php              # Rutas localizadas
│   └── rss.php              # Ruta /feed.xml
├── src/
│   ├── Content/             # ContentRepository, ContentItem
│   ├── Http/                # Router, Request, Response
│   ├── Support/             # Config, Env, Lang, Vite, helpers
│   └── View/                # Renderer (sistema de plantillas PHP nativo)
├── tests/
│   ├── Feature/             # Tests de integración (Pest)
│   └── Unit/                # Tests unitarios (Pest)
├── views/
│   ├── components/ui/       # Componentes reutilizables
│   ├── layouts/             # Layout base (base.php)
│   ├── errors/              # Páginas de error (404)
│   └── pages/               # Vistas de página
└── dist/                    # Salida del sitio estático (gitignored)
```

---

## Principios de ingeniería

- `declare(strict_types=1)` en todos los archivos PHP.
- Sin texto visible hardcodeado en vistas — todo pasa por `__('general.clave')`.
- Sin colores literales fuera de los design tokens CSS (`var(--color-*)`).
- Estados editoriales en cada entidad de contenido: `draft | pending | published`.
- Solo `published` es visible públicamente.
- Nunca publicar contenido histórico sin al menos una fuente estructurada en el content file.

---

## Sistema de routing

`Router` propio con soporte para:
- `GET` / `POST` con parámetros nombrados `{slug}`
- `group(prefix, fn)` para agrupar rutas bajo un prefijo
- Dispatch devuelve `Response` inmutable

```php
$router->get('/{locale}/noticias/{slug}', function (Request $req, string $slug): Response {
    // ...
});
```

---

## Sistema de vistas

`Renderer` con registro estático:

```php
// Renderizar con layout
$renderer->renderInLayout('layouts.base', 'pages.home', $data);

// Componentes (disponible globalmente vía helper)
component('ui.card', ['variant' => 'bordered', 'slot' => '...']);
```

Convención de nombres: `pages.home` → `views/pages/home.php`

---

## Modelo de contenido

Archivos PHP en `content/{type}/{slug}.php` que devuelven un array:

```php
return [
    'status'   => 'pending',   // draft | pending | published
    'title_es' => 'Título en español',
    'title_ca' => null,
    'title_en' => null,
];
```

`ContentRepository::findAll(type, status)` filtra por estado.
`ContentItem::trans(key, locale)` resuelve con fallback a `es`.

---

## Internacionalización

Archivos en `lang/{locale}/general.php` devolviendo arrays planos.
`Lang::setLocale()` + `Lang::load()` antes de cada dispatch.
Helper global `__('general.clave')` con soporte para `:placeholders`.
Locales: `es` (por defecto), `ca`, `en`.

---

## Sitio estático

`bin/build-static.php` pre-renderiza todas las rutas a `dist/` y genera:
- Páginas HTML por locale y slug
- `dist/index.html` — redirección a `/es/`
- `dist/sitemap.xml` — con hreflang alternates
- `dist/feed.xml` — RSS de noticias publicadas
- `dist/robots.txt` — copia de `public/robots.txt`

GitHub Actions (`deploy.yml`) ejecuta lint → tests → build → static → deploy en cada push a `main`.

---

## Rutas disponibles

```
GET /                         → redirección a /es/
GET /{locale}/                → Home
GET /{locale}/historia        → Historia y patrimonio
GET /{locale}/servicios       → Catálogo de servicios
GET /{locale}/servicios/{slug}→ Detalle de servicio
GET /{locale}/noticias        → Listado de noticias
GET /{locale}/noticias/{slug} → Detalle de noticia
GET /{locale}/horarios        → Horarios litúrgicos
GET /{locale}/visita          → Planificación de visita
GET /{locale}/contacto        → Datos de contacto
GET /{locale}/sobre           → Sobre la parroquia
GET /{locale}/aviso-legal     → Aviso legal
GET /{locale}/privacidad      → Política de privacidad
GET /{locale}/accesibilidad   → Declaración de accesibilidad
GET /feed.xml                 → RSS (noticias publicadas, idioma es)
```

Locales soportados: `es`, `ca`, `en`.
`APP_BASE_PATH=/parroquiamargarita` en producción (GitHub Pages).
