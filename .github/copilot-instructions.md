This file gives focused, actionable guidance to an AI coding assistant working on the
TableTrip Laravel app so it can be productive immediately.

Keep answers concise and make edits directly when safe. Follow the repository's
conventions and the examples below.

Key project facts
- Type: Laravel 12 application (PHP 8.2) with Vite + Tailwind for frontend assets.
- Entry points:
  - Backend: `app/` (models in `app/Models`, controllers in `app/Http/Controllers`).
  - Frontend: `resources/js/app.js`, `resources/css/app.css`, built to `public/build` by Vite.
  - Routes: `routes/web.php`, `routes/auth.php`.
- Tests: Pest / PHPUnit. Test config: `phpunit.xml` (uses in-memory sqlite for tests).

Developer workflows (commands you should use)
- Install + initial setup (runs migrations and builds assets):
  - `composer run setup` (runs composer install, creates .env, runs migrations, npm install, builds assets)
- Start a development environment with backend + frontend + logs (concurrent):
  - `composer run dev` (runs `php artisan serve`, queues, pail, and `npm run dev` concurrently)
  - Or run frontend only: `npm run dev` (Vite HMR)
- Run tests:
  - `composer run test` — runs `php artisan test` via composer script.
  - For direct Pest runs: `./vendor/bin/pest`.

Project-specific conventions and patterns
- PSR-4 autoloading: namespaces use `App\\` mapped to `app/`. When creating files, keep namespaces matching file paths.
- Controllers are organized under `app/Http/Controllers`. Example: `app/Http/Controllers/Oener/RestaurantAuthController.php` (note: check for folder/name typos like `Oener` vs `Owner` before renaming).
- Models live in `app/Models` (examples: `Restaurant.php`, `Reservation.php`, `Category.php`). Migrations live under `database/migrations` with timestamped filenames.
- Blade views are under `resources/views`; components are in `resources/views/components` and `app/View/Components` when backed by a class.
- Frontend assets assume Vite + Tailwind — make changes in `resources/js`/`resources/css` and run `npm run build` or `npm run dev`.

Integration & important files to inspect for any non-trivial change
- `composer.json` — project scripts (`setup`, `dev`, `test`) and dev dependencies (Pest, Breeze, Pint, Pail).
- `package.json` — `dev` and `build` scripts for Vite.
- `phpunit.xml` — test environment overrides (sqlite in-memory, queue sync, mail driver = array).
- `routes/web.php` and `routes/auth.php` — where to add or adjust route definitions.
- `database/migrations/*` — use migration files as the source of truth for schema changes.

How to propose a change
- Small code change (fix a bug, update a route, add a small controller method):
  - Edit the file, run `composer run test` locally, and ensure no failing tests.
  - If the change touches frontend assets, run `npm run dev` (or `npm run build`) and verify the built files appear in `public/build`.
- Larger changes (new features, DB schema changes):
  - Add or update migrations in `database/migrations` and create/adjust tests in `tests/Feature` or `tests/Unit`.
  - Run `php artisan migrate` (or `composer run setup` in a fresh environment) and run tests.

Examples (use these as templates)
- Add a resource controller wired to a model:
  - `php artisan make:controller RestaurantController --resource --model=App\\Models\\Restaurant`
  - Register route: `Route::resource('restaurants', RestaurantController::class);` in `routes/web.php`.

Notes and pitfalls
- The repository uses several vendor tools (Breeze, Pail, Pint). Check `composer.json` before adding similar packages.
- Tests use an in-memory sqlite DB via `phpunit.xml` — tests that rely on a file-based sqlite DB should be adapted or have explicit setup in the test.
- Be careful renaming namespaces or directories (e.g., `Oener` appears to be a typo for `Owner`) — check for references before renaming.

If anything is unclear or you want the agent to take an action (create a controller, add a route, update a view, or run tests), tell me which task to perform and I will: search relevant files, create the change, run the tests, and report results.
