# Arquitectura técnica

**Proyecto:** Web Parroquia Castrense de Santa Margarita de Mallorca  
**Stack:** PHP 8.4 · Laravel 11 · Blade · Tailwind CSS v4 · Alpine.js

---

## Estructura del repositorio

```
/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controladores por página/sección
│   │   ├── Middleware/      # SetLocale, SecurityHeaders, etc.
│   │   └── Requests/        # Form Requests (validación)
│   ├── Models/              # Modelos Eloquent
│   └── Services/            # Lógica de negocio desacoplada
├── config/                  # Configuración Laravel
├── database/
│   ├── migrations/          # Migraciones de base de datos
│   └── seeders/             # Datos demo (marcados como DEMO)
├── docs/
│   ├── adr/                 # Architecture Decision Records
│   ├── architecture.md      # Este archivo
│   ├── content-governance.md
│   └── sdd-workflow.md
├── lang/
│   ├── es/                  # Español (estructural)
│   ├── ca/                  # Catalán de Mallorca (estructural)
│   ├── en/                  # Inglés (preparado)
│   ├── de/                  # Alemán (preparado)
│   ├── fr/                  # Francés (preparado)
│   └── it/                  # Italiano (preparado)
├── public/                  # Punto de entrada web
├── resources/
│   ├── css/app.css          # Design tokens + estilos globales
│   ├── js/app.js            # Alpine.js bootstrap
│   └── views/
│       ├── components/
│       │   ├── layout/      # Header, Footer, Nav, MobileMenu
│       │   └── ui/          # Button, Card, Hero, Timeline, etc.
│       ├── pages/           # Vistas de página completa
│       └── partials/        # Fragmentos reutilizables
├── routes/
│   └── web.php              # Rutas localizadas
├── tests/
│   ├── Feature/             # Tests de integración (Pest)
│   ├── Unit/                # Tests unitarios (Pest)
│   └── Browser/             # Tests E2E (Playwright)
└── vite.config.js
```

---

## Principios de ingeniería

- `declare(strict_types=1)` en todos los archivos PHP.
- Sin texto visible hardcodeado en vistas Blade.
- Sin colores literales fuera de los design tokens CSS.
- Componentes Blade anónimos para UI (`<x-ui.button>`, `<x-ui.card>`, etc.).
- Separación estricta: datos en modelos/servicios, presentación en Blade.
- Estados editoriales en cada entidad de contenido.
- CSRF activo en todos los formularios POST.

---

## Rutas localizadas

```
GET /               → redirección a /es
GET /es             → Home (español)
GET /ca             → Home (catalán)
GET /es/historia    → Historia (español)
GET /ca/historia    → Història (catalán)
...
```

---

## Fases SDD

Ver `docs/sdd-workflow.md`.
