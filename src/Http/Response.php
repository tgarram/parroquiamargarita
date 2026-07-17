<?php

declare(strict_types=1);

namespace Parroquia\Http;

final class Response
{
    /** @param array<string, string> $headers */
    public function __construct(
        private string $body = '',
        private int $status = 200,
        private array $headers = ['Content-Type' => 'text/html; charset=UTF-8'],
    ) {}

    public function withStatus(int $status): static
    {
        $clone = clone $this;
        $clone->status = $status;

        return $clone;
    }

    public function withHeader(string $name, string $value): static
    {
        $clone = clone $this;
        $clone->headers[$name] = $value;

        return $clone;
    }

    public function withBody(string $body): static
    {
        $clone = clone $this;
        $clone->body = $body;

        return $clone;
    }

    public function send(): never
    {
        http_response_code($this->status);

        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        echo $this->body;

        exit(0);
    }

    public static function redirect(string $url, int $status = 302): static
    {
        return (new static('', $status))->withHeader('Location', $url);
    }

    public static function notFound(string $body = ''): static
    {
        return new static($body, 404);
    }
}
