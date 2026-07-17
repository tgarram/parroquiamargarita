# ADR-002 — Stack Frontend

**Estado:** Aceptado  
**Fecha:** 2026-07-17

---

## Contexto

La web necesita interactividad básica (menú móvil, acordeones, banners descartables) sin requerir un framework JavaScript completo.

---

## Decisión

- **Tailwind CSS v4** para estilos, con design tokens definidos en `app.css`.
- **Alpine.js** para interactividad mínima declarativa en HTML.
- **Vite** para compilación de assets.

---

## Alternativas consideradas

| Opción | Motivo de descarte |
|---|---|
| React / Vue | Innecesario para una web institucional |
| Laravel Livewire | Añade complejidad para casos de uso simples |
| JavaScript puro | Mantenimiento costoso |
| Bootstrap | Difícil mantener la estética Ultra Quiet Luxury |

---

## Consecuencias

- Toda interactividad JS se declara con atributos `x-` de Alpine directamente en Blade.
- Los design tokens son variables CSS en `app.css`.
- Se pueden añadir componentes Livewire en fases posteriores si surge necesidad justificada.
