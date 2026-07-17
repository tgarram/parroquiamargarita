# Parroquia Castrense de Santa Margarita de Mallorca

Web oficial · Versión 1.0 · En desarrollo

---

## Stack

- PHP 8.4 · Laravel 11
- Blade (plantillas)
- Tailwind CSS v4 (design tokens)
- Alpine.js (interactividad)
- Pest PHP (tests)
- Playwright (tests E2E)

---

## Requisitos

- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 20.x
- MySQL 8 o PostgreSQL 16

---

## Instalación

```bash
git clone https://github.com/tgarram/parroquiamargarita.git
cd parroquiamargarita

composer install
npm install

cp .env.example .env
php artisan key:generate

# Configurar la base de datos en .env, después:
php artisan migrate
php artisan db:seed --class=DemoSeeder
```

## Desarrollo

```bash
php artisan serve
npm run dev
```

## Tests

```bash
./vendor/bin/pest            # unitarios e integración
npx playwright test          # E2E
```

## Lint y formato

```bash
./vendor/bin/pint --test     # verificar
./vendor/bin/pint            # aplicar
```

## Build producción

```bash
npm run build
```

---

## Documentación

- `docs/architecture.md` — Arquitectura técnica
- `docs/adr/` — Architecture Decision Records
- `docs/content-governance.md` — Gobernanza de contenido
- `docs/sdd-workflow.md` — Fases SDD y estado del proyecto

---

## Metodología

Este proyecto sigue **Spec-Driven Development (SDD)**: cada fase tiene criterios de aceptación verificables. No se avanza a la siguiente fase sin cumplirlos todos.

---

## Importante

- Todo el contenido demo está marcado como `[DEMO]`.
- Ningún dato histórico se publica sin fuente verificada.
- No existen textos reales de la parroquia hasta confirmación oficial.
