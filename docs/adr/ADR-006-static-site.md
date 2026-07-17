# ADR-006 — Generación de sitio estático

**Estado:** Aceptado
**Fecha:** 2026-07-17

---

## Contexto

El sitio necesita desplegarse sin coste de servidor y con máxima disponibilidad.
GitHub Pages ofrece hosting estático gratuito bajo el dominio `tgarram.github.io`.

## Decisión

Se usa `bin/build-static.php` para pre-renderizar todas las rutas conocidas a HTML
y se despliega el resultado en GitHub Pages.

**Flujo:**

1. `npm run build` — compila assets con Vite y genera `public/build/manifest.json`.
2. `php bin/build-static.php` — itera sobre todas las rutas, llama al router internamente
   y escribe el HTML resultante en `dist/`.
3. GitHub Actions sube `dist/` como artefacto de Pages y lo despliega.

**Archivos generados:**

| Archivo | Descripción |
|---|---|
| `dist/{locale}/{page}/index.html` | Páginas pre-renderizadas |
| `dist/index.html` | Redirección meta-refresh a `/es/` |
| `dist/sitemap.xml` | Sitemap con hreflang alternates |
| `dist/feed.xml` | RSS de noticias publicadas |
| `dist/robots.txt` | Copia de `public/robots.txt` |
| `dist/.nojekyll` | Evita que GitHub Pages procese assets con `_` o `.` |

## Consecuencias

- **Sin servidor en tiempo de petición**: no hay sesiones, formularios POST ni
  procesamiento dinámico.
- **Rutas nuevas requieren re-build**: añadir una ruta exige actualizar `$baseRoutes`
  en `bin/build-static.php` y hacer un nuevo deploy.
- **`APP_BASE_PATH=/parroquiamargarita`**: todas las URLs internas se prefijan con este
  valor en producción vía el helper `base_path()`.
- **Alternativa**: si se requieren formularios o contenido dinámico, el servidor PHP
  con `public/index.php` funciona sin cambiar el código de la app.
