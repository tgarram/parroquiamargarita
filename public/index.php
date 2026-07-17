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

// 3. Locale
Lang::setLocale((string) Config::get('app.locale', 'es'));
Lang::load(dirname(__DIR__).'/lang');

// 4. Assets (Vite manifest)
Vite::load((string) Config::get('vite.manifest'));

// 5. Request
$request = Request::fromGlobals();

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
            'title' => 'Página no encontrada',
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
