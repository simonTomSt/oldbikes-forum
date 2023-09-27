<?php

declare(strict_types=1);

namespace App\Core;

class Application
{
    public static string $ROOT_PATH;

    private readonly Router $router;
    private readonly Request $request;

    public function __construct(array $config)
    {
        self::$ROOT_PATH = $config['rootPath'];

        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run(): void
    {
        $this->router->resolve();
    }

    public function get(string $path, array $controller): void
    {
        $this->router->setRoute('GET', $path, $controller);
    }

    public function post(string $path, array $controller): void
    {
        $this->router->setRoute('POST', $path, $controller);
    }

    public static function resolveFilePath($path): string
    {
        return self::$ROOT_PATH . "{$path}";
    }
}