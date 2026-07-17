# ADR-001 — Framework PHP

**Estado:** Aceptado  
**Fecha:** 2026-07-17  
**Decisión tomada por:** Responsable del proyecto

---

## Contexto

La especificación original del proyecto contemplaba Next.js + React + TypeScript como stack frontend. El responsable del proyecto ha solicitado implementar la web en PHP.

---

## Decisión

Se utilizará **Laravel 11** como framework PHP principal.

---

## Alternativas consideradas

| Opción | Ventajas | Inconvenientes |
|---|---|---|
| Laravel 11 | Ecosistema maduro, Blade, i18n nativo, Eloquent, comunidad amplia | Ninguno relevante para este proyecto |
| Symfony 7 | Muy robusto, componentes desacoplados | Mayor complejidad inicial |
| PHP puro | Sin dependencias | Sin routing, sin ORM, sin validación |
| WordPress | Fácil para contenido | Arquitectura rígida, difícil de personalizar |

---

## Consecuencias

- Las plantillas se implementan con **Blade**.
- La internacionalización usa el sistema nativo de Laravel (`lang/`).
- La validación de formularios usa **Laravel Form Requests**.
- Los tests unitarios usan **Pest PHP**.
- Los tests E2E usan **Playwright**.
- La gestión de assets usa **Vite** con el plugin oficial de Laravel.
