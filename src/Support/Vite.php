<?php

declare(strict_types=1);

namespace Parroquia\Support;

final class Vite
{
    /** @var array<string, array{file: string, css?: string[]}> */
    private static array $manifest = [];

    private static bool $loaded = false;

    public static function load(string $manifestPath): void
    {
        if (! is_file($manifestPath)) {
            return;
        }

        $json = file_get_contents($manifestPath);

        if ($json === false) {
            return;
        }

        /** @var array<string, array{file: string, css?: string[]}> $data */
        $data = json_decode($json, true) ?? [];
        self::$manifest = $data;
        self::$loaded = true;
    }

    public static function asset(string $entry): string
    {
        if (! self::$loaded) {
            return '/build/'.$entry;
        }

        return '/build/'.(self::$manifest[$entry]['file'] ?? $entry);
    }

    /**
     * Returns <link> and <script> tags for the given entry point.
     */
    public static function tags(string $entry): string
    {
        if (! self::$loaded) {
            return '';
        }

        $chunk = self::$manifest[$entry] ?? null;

        if ($chunk === null) {
            return '';
        }

        $html = '';

        foreach ($chunk['css'] ?? [] as $css) {
            $href = htmlspecialchars('/build/'.$css, ENT_QUOTES);
            $html .= "<link rel=\"stylesheet\" href=\"{$href}\">\n";
        }

        $src = htmlspecialchars('/build/'.$chunk['file'], ENT_QUOTES);
        $html .= "<script type=\"module\" src=\"{$src}\"></script>\n";

        return $html;
    }
}
