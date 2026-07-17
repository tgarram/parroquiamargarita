<?php

declare(strict_types=1);

namespace Parroquia\Support;

final class Lang
{
    private static string $locale = 'es';

    /** @var array<string, array<string, mixed>> */
    private static array $lines = [];

    public static function setLocale(string $locale): void
    {
        self::$locale = $locale;
    }

    public static function getLocale(): string
    {
        return self::$locale;
    }

    public static function load(string $langDir): void
    {
        $dir = rtrim($langDir, '/').'/'.self::$locale;

        if (! is_dir($dir)) {
            return;
        }

        foreach (glob("{$dir}/*.php") ?: [] as $file) {
            $stem = basename($file, '.php');
            self::$lines[$stem] = require $file;
        }
    }

    public static function trans(string $key, array $replace = []): string
    {
        $parts = explode('.', $key, 2);
        $group = $parts[0];
        $item = $parts[1] ?? '';

        $value = self::$lines[$group][$item] ?? $key;

        if (! is_string($value)) {
            return $key;
        }

        foreach ($replace as $placeholder => $replacement) {
            $value = str_replace(':'.$placeholder, (string) $replacement, $value);
        }

        return $value;
    }
}
