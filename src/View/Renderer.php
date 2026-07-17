<?php

declare(strict_types=1);

namespace Parroquia\View;

final class Renderer
{
    private static ?self $instance = null;

    public function __construct(private readonly string $viewsDir) {}

    public static function register(self $renderer): void
    {
        self::$instance = $renderer;
    }

    public static function component(string $name, array $props = []): string
    {
        if (self::$instance === null) {
            return '';
        }

        return self::$instance->render('components.'.$name, $props);
    }

    public function render(string $view, array $data = []): string
    {
        $file = $this->resolve($view);

        extract($data, EXTR_SKIP);

        ob_start();

        require $file;

        return (string) ob_get_clean();
    }

    public function renderInLayout(string $layout, string $view, array $data = []): string
    {
        $data['content'] = $this->render($view, $data);

        return $this->render($layout, $data);
    }

    private function resolve(string $view): string
    {
        $relative = str_replace('.', '/', $view).'.php';
        $file = rtrim($this->viewsDir, '/').'/'.$relative;

        if (! is_file($file)) {
            throw new \RuntimeException("View not found: {$view} (looked at {$file})");
        }

        return $file;
    }
}
