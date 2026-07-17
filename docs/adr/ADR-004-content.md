# ADR-004 — Gestión de contenido

**Estado:** Pendiente de confirmación  
**Fecha:** 2026-07-17

---

## Decisión provisional

Para el MVP se usará **Filament PHP** como panel de administración sobre Laravel.

Filament permite:
- CRUD de todas las entidades.
- Roles y permisos.
- Campos localizados (con `spatie/laravel-translatable`).
- Historial de cambios (con `spatie/laravel-activitylog`).

---

## Pendiente de confirmar

- ¿Se quiere Filament o se prefiere otro panel?
- ¿La base de datos será MySQL o PostgreSQL?

---

## Consecuencias

- El modelo de datos se define en migraciones Laravel.
- Los estados editoriales se implementan en cada modelo.
- El contenido histórico exige al menos una fuente documentada antes de publicarse.
