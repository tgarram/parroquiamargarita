<?php

declare(strict_types=1);

namespace Parroquia\Content;

/**
 * Immutable value object representing a single content item.
 *
 * @property-read string               $type
 * @property-read string               $slug
 * @property-read string               $status   draft|pending|published
 * @property-read array<string, mixed> $data
 */
final readonly class ContentItem
{
    /** @param array<string, mixed> $data */
    public function __construct(
        public string $type,
        public string $slug,
        public string $status,
        public array $data,
    ) {}

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    /** Returns translated field, falling back to default locale key. */
    public function trans(string $key, string $locale, string $fallback = 'es'): mixed
    {
        return $this->data[$key.'_'.$locale]
            ?? $this->data[$key.'_'.$fallback]
            ?? $this->data[$key]
            ?? null;
    }
}
