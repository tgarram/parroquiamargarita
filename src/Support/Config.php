<?php

declare(strict_types=1);

namespace Parroquia\Support;

final class Config
{
    /** @var array<string, mixed> */
    private static array $data = [];

    public static function load(string $configDir): void
    {
        foreach (glob(rtrim($configDir, '/').'/*.php') ?: [] as $file) {
            $stem = basename($file, '.php');
            self::$data[$stem] = require $file;
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $parts = explode('.', $key);
        $value = self::$data;

        foreach ($parts as $part) {
            if (! is_array($value) || ! array_key_exists($part, $value)) {
                return $default;
            }
            $value = $value[$part];
        }

        return $value;
    }
}
