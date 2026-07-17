# SDD Workflow — Spec-Driven Development

**Proyecto:** Web Parroquia Castrense de Santa Margarita de Mallorca
**Stack:** PHP 8.3+ puro (namespace `Parroquia\`), Tailwind CSS v4, Alpine.js, Vite
**Despliegue:** Sitio estático en GitHub Pages vía `bin/build-static.php`

---

## Orden de fases

| Fase | Nombre | Estado |
|---|---|---|
| 0 | Inicialización y estructura base | ✅ Completada |
| 1 | Design tokens y base visual | ✅ Completada |
| 2 | Componentes de interfaz (11 componentes UI) | ✅ Completada |
| 3 | Internacionalización (es / ca / en) | ✅ Completada |
| 4 | Layout global y navegación | ✅ Completada |
| 5 | Modelo de contenido y datos (file-based, estados editoriales) | ✅ Completada |
| 6 | Página de inicio | ✅ Completada |
| 7 | Página 404 mejorada | ✅ Completada |
| 8 | Sección de noticias (índice + detalle) | ✅ Completada |
| 9 | Página de horarios | ✅ Completada |
| 10 | Página de contacto | ✅ Completada |
| 11 | SEO: meta description, canonical, sitemap.xml, robots.txt | ✅ Completada |
| 12 | Open Graph, Twitter Card y JSON-LD | ✅ Completada |
| 13 | Página "Sobre la Parroquia" | ✅ Completada |
| 14 | Footer enriquecido (tres columnas con nav y legal) | ✅ Completada |
| 15 | Páginas legales (aviso legal, privacidad, accesibilidad) | ✅ Completada |
| 16 | Rendimiento: favicon, theme-color, carga async de fuentes | ✅ Completada |
| 17 | Auditoría accesibilidad WCAG 2.2 AA | ✅ Completada |
| 18 | Preparación de producción | ✅ Completada |
| 19 | Página de historia y patrimonio | ✅ Completada |
| 20 | Servicios pastorales (índice + detalle) | ✅ Completada |
| 21 | Página de visita | ✅ Completada |
| 22 | Página de inicio enriquecida (8 secciones) | ✅ Completada |
| 23 | RSS feed (/feed.xml) y autodiscovery | ✅ Completada |
| 24 | Sitemap completo con slugs de servicios | ✅ Completada |

---

## Reglas del proyecto

1. No avanzar de fase sin que todos los criterios de aceptación estén cumplidos.
2. Cada fase termina con: pint (lint), pest (tests), commit, push.
3. **No inventar contenido real** (datos, horarios, teléfonos, historia, direcciones).
4. Todo dato no confirmado se marca como `status => 'pending'` en el content file.
5. Solo `status => 'published'` es visible públicamente.
6. Los ADR documentan cada decisión arquitectónica relevante.

---

## Comandos de desarrollo

```bash
# Servidor de desarrollo (PHP built-in)
php -S localhost:8000 -t public

# Assets en watch mode
npm run dev

# Lint PHP (debe pasar sin errores antes de commit)
./vendor/bin/pint --test

# Tests
./vendor/bin/pest

# Build de assets
npm run build

# Generar sitio estático en dist/
APP_BASE_PATH=/parroquiamargarita \
APP_URL=https://tgarram.github.io/parroquiamargarita \
php bin/build-static.php
```

---

## Estructura de contenido

```
content/
  noticias/        # Artículos con status: draft | pending | published
  horarios/        # Entradas de horario litúrgico
  paginas/         # Páginas estáticas (sobre, contacto, aviso-legal, etc.)
```

Solo los items con `'status' => 'published'` son visibles en el sitio.
Los archivos con `'status' => 'pending'` muestran un aviso informativo.

---

## Páginas disponibles

| Ruta | Vista | Descripción |
|---|---|---|
| `/{locale}/` | `pages/home` | Página de inicio |
| `/{locale}/sobre` | `pages/sobre` | Sobre la parroquia |
| `/{locale}/noticias` | `pages/noticias/index` | Listado de noticias |
| `/{locale}/noticias/{slug}` | `pages/noticias/show` | Detalle de noticia |
| `/{locale}/horarios` | `pages/horarios` | Horarios litúrgicos |
| `/{locale}/contacto` | `pages/contacto` | Datos de contacto |
| `/{locale}/historia` | `pages/historia` | Historia y patrimonio |
| `/{locale}/servicios` | `pages/servicios/index` | Catálogo de servicios pastorales |
| `/{locale}/servicios/{slug}` | `pages/servicios/show` | Detalle de servicio |
| `/{locale}/visita` | `pages/visita` | Planificación de visita |
| `/{locale}/aviso-legal` | `pages/legal` | Aviso legal |
| `/{locale}/privacidad` | `pages/legal` | Política de privacidad |
| `/{locale}/accesibilidad` | `pages/legal` | Declaración de accesibilidad |

Locales disponibles: `es` (por defecto), `ca`, `en`.
