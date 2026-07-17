# ADR-005 — Motor de formularios

**Estado:** Aceptado  
**Fecha:** 2026-07-17

---

## Decisión

Los formularios se implementan con:

- **Laravel Form Requests** para validación en servidor.
- **Blade** para renderizado.
- **Alpine.js** para estados visuales en cliente.
- **Honeypot** como protección anti-spam principal.
- **Rate limiting** mediante middleware de Laravel.
- **Laravel Mail** desacoplado con driver configurable por entorno.

---

## Flujo

```
Usuario rellena → Validación Alpine → POST → CSRF check
→ Rate limit → Honeypot check → Form Request validation
→ Servicio de envío → Confirmación con referencia → Email log (dev) / real (prod)
```

---

## Formularios iniciales (Fase 8)

- Consulta general
- Intención de misa
- Solicitud de certificado
- Visita de grupo
- Acompañamiento espiritual
- Solicitud genérica de servicio

---

## Consecuencias

- Los errores de validación se muestran junto a cada campo.
- El consentimiento RGPD se registra con timestamp y versión.
- En desarrollo, el mail usa el driver `log`.
