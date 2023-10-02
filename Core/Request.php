<?php

declare(strict_types=1);

namespace App\Core;

class Request
{
    private array $routeParams = [];


    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/404';

        return $this->normalizePath($path);
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    private function normalizePath(string $path): string
    {
        $position = strpos($path, '?');

        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        $path = trim($path, '/');
        $path = "/{$path}";

        return preg_replace('#/{2,}#', '/', $path);
    }

    public function getBody(): ?array
    {
        if ($this->getMethod() === 'GET') {
            return null;
        }

        return $_POST;
    }

    public function getQuery(): array
    {
        $query = [];

        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $query);
        }

        return $query;
    }

    public function getUrlParams(): array
    {
        return $this->routeParams;
    }

    public function setUrlParams(array $routeParams): void
    {
        $this->routeParams = $routeParams;
    }
}