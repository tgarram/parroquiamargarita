<?php

declare(strict_types=1);

require dirname(__DIR__).'/vendor/autoload.php';

use Parroquia\Http\Request;
use Parroquia\Http\Response;
use Parroquia\Http\Router;
use Parroquia\Support\Config;
use Parroquia\Support\Env;
use Parroquia\Support\Lang;
use Parroquia\Support\Vite;
use Parroquia\View\Renderer;

// 1. Entorno
Env::load(dirname(__DIR__));

// 2. Configuración
Config::load(dirname(__DIR__).'/config');

// 3. Request temprano (necesario para detectar locale)
$request = Request::fromGlobals();

// 4. Detectar locale desde primer segmento de la URL
/** @var string[] $supportedLocales */
$supportedLocales = Config::get('app.locales', ['es', 'ca', 'en']);
$firstSegment = explode('/', ltrim($request->path, '/'))[0] ?? '';
$locale = in_array($firstSegment, $supportedLocales, true)
    ? $firstSegment
    : (string) Config::get('app.locale', 'es');

Lang::setLocale($locale);
Lang::load(dirname(__DIR__).'/lang');

// 5. Assets (Vite manifest)
Vite::load((string) Config::get('vite.manifest'));

// 6. Infraestructura
$renderer = new Renderer(dirname(__DIR__).'/views');
Renderer::register($renderer);
$router = new Router;

// 7. Rutas
$register = require dirname(__DIR__).'/routes/web.php';
$register($router, $renderer);

// 8. Dispatch
try {
    $response = $router->dispatch($request);

    if ($response->withStatus(404) === $response) {
        $body = $renderer->renderInLayout('layouts.base', 'errors.404', [
            'title' => __('general.page_not_found'),
        ]);
        $response = $response->withBody($body);
    }
} catch (Throwable $e) {
    $debug = (bool) Config::get('app.debug', false);
    $body = $debug
        ? '<pre style="padding:2rem;font-family:monospace">'.htmlspecialchars((string) $e, ENT_QUOTES).'</pre>'
        : '<main style="padding:4rem;text-align:center"><h1>Error interno</h1><p>Por favor, inténtalo más tarde.</p></main>';

    $response = new Response($body, 500);
}

$response->send();
