<?php

declare(strict_types=1);

use Parroquia\Support\Env;

return [
    'name' => Env::get('APP_NAME', 'Parroquia Castrense de Santa Margarita'),
    'locale' => Env::get('APP_LOCALE', 'es'),
    'locales' => ['es', 'ca', 'en'],
    'debug' => Env::get('APP_DEBUG', false),
    'url' => Env::get('APP_URL', 'http://localhost:8000'),
];
