<?php

declare(strict_types=1);

namespace Parroquia\Content;

final class ContentRepository
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, '/');
    }

    /**
     * Find all items of a type, optionally filtered by status.
     *
     * @return ContentItem[]
     */
    public function findAll(string $type, string $status = 'published'): array
    {
        $dir = $this->basePath.'/'.$type;

        if (! is_dir($dir)) {
            return [];
        }

        $items = [];

        foreach (glob("{$dir}/*.php") ?: [] as $file) {
            $item = $this->loadFile($type, $file);

            if ($item !== null && ($status === '*' || $item->status === $status)) {
                $items[] = $item;
            }
        }

        usort($items, static fn (ContentItem $a, ContentItem $b) => $a->slug <=> $b->slug);

        return $items;
    }

    public function find(string $type, string $slug, string $status = 'published'): ?ContentItem
    {
        $file = $this->basePath.'/'.$type.'/'.$slug.'.php';

        if (! is_file($file)) {
            return null;
        }

        $item = $this->loadFile($type, $file);

        if ($item === null || ($status !== '*' && $item->status !== $status)) {
            return null;
        }

        return $item;
    }

    private function loadFile(string $type, string $file): ?ContentItem
    {
        /** @var array<string, mixed>|null $data */
        $data = require $file;

        if (! is_array($data)) {
            return null;
        }

        $slug = basename($file, '.php');
        $status = isset($data['status']) && is_string($data['status']) ? $data['status'] : 'draft';

        return new ContentItem($type, $slug, $status, $data);
    }
}
