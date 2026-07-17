<?php

declare(strict_types=1);

namespace Parroquia\Http;

final class Response
{
    /** @param array<string, string> $headers */
    public function __construct(
        public readonly string $body = '',
        public readonly int $status = 200,
        private array $headers = ['Content-Type' => 'text/html; charset=UTF-8'],
    ) {}

    public function withStatus(int $status): static
    {
        return new self($this->body, $status, $this->headers);
    }

    public function withHeader(string $name, string $value): static
    {
        $headers = $this->headers;
        $headers[$name] = $value;

        return new static($this->body, $this->status, $headers);
    }

    public function withBody(string $body): static
    {
        return new static($body, $this->status, $this->headers);
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
