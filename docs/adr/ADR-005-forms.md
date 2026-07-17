# ADR-005 — Formularios de contacto

**Estado:** Supersedido por ADR-001 (sitio estático)
**Fecha:** 2026-07-17

---

## Contexto

El pliego inicial preveía un motor de formularios con validación en servidor,
envío de correo y registro de consentimiento RGPD.

## Decisión

**No se implementa un motor de formularios en servidor.**

El sitio se despliega como HTML estático en GitHub Pages (ver ADR-001),
que no puede ejecutar PHP en tiempo de petición. Por tanto:

- Las páginas de servicio enlazan a `/contacto` en lugar de incrustar formularios.
- La página `/contacto` muestra los datos de contacto oficiales (cuando estén confirmados)
  con estado `pending` hasta entonces.
- Si en el futuro se requiere un formulario funcional, las opciones son:
  - Servicio externo (Formspree, Netlify Forms, etc.) con acción `action=""` en el HTML.
  - Migrar el despliegue a un servidor PHP con `public/index.php`.

## Consecuencias

- Sin procesamiento POST, sin envío de correo, sin registro RGPD desde el frontend.
- El canal de contacto es la información publicada en `/contacto`.
- La decisión es revisable si el despliegue deja de ser estático.
