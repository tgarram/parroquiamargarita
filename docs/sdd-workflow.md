# SDD Workflow — Spec-Driven Development

**Proyecto:** Web Parroquia Castrense de Santa Margarita de Mallorca

---

## Orden de fases

| Fase | Nombre | Estado |
|---|---|---|
| 0 | Inicialización | ✅ Completada |
| 1 | Design tokens y base visual | ✅ Completada |
| 2 | Componentes de interfaz | ⏳ Pendiente |
| 3 | Internacionalización | ⏳ Pendiente |
| 4 | Layout global y navegación | ⏳ Pendiente |
| 5 | Modelo de contenido y datos | ⏳ Pendiente |
| 6 | Página de inicio | ⏳ Pendiente |
| 7 | Página de servicios | ⏳ Pendiente |
| 8 | Motor de formularios | ⏳ Pendiente |
| 9 | Horarios y agenda | ⏳ Pendiente |
| 10 | Historia y patrimonio | ⏳ Pendiente |
| 11 | La historia que casi nadie conoce | ⏳ Pendiente |
| 12 | Visita y orientación turística | ⏳ Pendiente |
| 13 | Noticias, avisos y comunicados | ⏳ Pendiente |
| 14 | Funcionalidades diferenciales | ⏳ Pendiente (selectiva) |
| 15 | CMS y flujo editorial | ⏳ Pendiente |
| 16 | Analítica respetuosa | ⏳ Pendiente |
| 17 | Rendimiento, SEO y accesibilidad final | ⏳ Pendiente |
| 18 | Preparación de producción | ⏳ Pendiente |

---

## Reglas

1. No avanzar de fase sin que todos los criterios de aceptación estén cumplidos.
2. Cada fase termina con: lint, tests, build, revisión responsive, revisión accesibilidad.
3. No inventar contenido real (datos, horarios, teléfonos, historia).
4. Todo dato no confirmado se marca como `[DEMO]` o `pending`.
5. Los ADR documentan cada decisión arquitectónica relevante.

---

## Comandos de desarrollo

```bash
# Servidor de desarrollo
php artisan serve
npm run dev

# Lint PHP
./vendor/bin/pint --test

# Tests unitarios e integración
./vendor/bin/pest

# Tests E2E
npx playwright test

# Build assets
npm run build
```
