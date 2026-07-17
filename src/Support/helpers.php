<?php

declare(strict_types=1);

use Parroquia\Support\Config;
use Parroquia\Support\Lang;
use Parroquia\Support\Vite;

if (! function_exists('__')) {
    function __(string $key, array $replace = []): string
    {
        return Lang::trans($key, $replace);
    }
}

if (! function_exists('config')) {
    function config(string $key, mixed $default = null): mixed
    {
        return Config::get($key, $default);
    }
}

if (! function_exists('vite')) {
    function vite(string $entry): string
    {
        return Vite::tags($entry);
    }
}

if (! function_exists('e')) {
    function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
