# Gobernanza de contenido

**Proyecto:** Web Parroquia Castrense de Santa Margarita de Mallorca

---

## Estados editoriales

| Estado | Descripción | Visible al público |
|---|---|---|
| `draft` | Borrador en edición | No |
| `pending_review` | Pendiente de revisión | No |
| `verified` | Revisado y aprobado | No |
| `published` | Publicado | Sí |
| `archived` | Archivado | No |

**Regla inmutable:** solo el estado `published` es visible al público.

---

## Contenido histórico

Toda afirmación histórica debe incluir:

- Fuente (autor, tipo, fecha, referencia).
- Nivel de verificación.
- Notas editoriales cuando proceda.

Nunca publicar contenido histórico sin al menos una fuente estructurada.

---

## Roles

| Rol | Permisos |
|---|---|
| Administrador | Control total |
| Editor | Crear y editar contenido |
| Revisor | Aprobar o bloquear publicación |
| Traductor | Gestionar únicamente traducciones |

---

## Ciclo de vida

```
Crear (draft)
  → Enviar a revisión (pending_review)
  → Verificar contenido (verified)
  → Publicar (published)
  → Actualizar o archivar
```

---

## Contenido demo

Los datos de ejemplo creados durante el desarrollo deben:

- Estar marcados como `[DEMO]` en el campo `notes`.
- Tener estado `draft`.
- No publicarse en producción.
- Eliminarse o sustituirse antes del despliegue.

---

## IA y contenido

- La IA puede ayudar a redactar borradores.
- Ningún contenido generado por IA se publica directamente.
- El contenido histórico siempre requiere validación humana con fuentes verificadas.
