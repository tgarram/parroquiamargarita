<?php

declare(strict_types=1);

namespace Parroquia\Http;

final class Router
{
    /** @var array<string, array<string, callable>> */
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, callable $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    public function add(string $method, string $path, callable $handler): void
    {
        $this->routes[strtoupper($method)][$path] = $handler;
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->method;
        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $pattern => $handler) {
            $regex = $this->compilePattern($pattern);

            if (preg_match($regex, $request->path, $matches) !== 1) {
                continue;
            }

            // Extract only named string captures
            $params = array_filter(
                $matches,
                static fn ($k) => is_string($k),
                ARRAY_FILTER_USE_KEY,
            );

            return $handler($request, ...$params);
        }

        return Response::notFound();
    }

    private function compilePattern(string $pattern): string
    {
        $regex = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '(?P<$1>[^/]+)', $pattern);

        return '#^'.$regex.'$#u';
    }
}
