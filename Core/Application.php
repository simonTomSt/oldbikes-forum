<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exception\NotFoundException;

class Application
{
    public static string $ROOT_PATH;
    public static Database $database;

    private readonly Router $router;
    private readonly Request $request;

    public function __construct(array $config)
    {
        self::$ROOT_PATH = $config['rootPath'];
        self::$database = new Database($config['db']);

        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run(): void
    {
        try {
            $this->router->resolve();
        } catch (NotFoundException) {
            echo View::renderView('_404');
        } catch (\Exception $e) {
            debug($e);
            echo View::renderView('_500');
        }
    }

    public function get(string $path, array $controller, array $middlewares = []): void
    {
        $this->router->setRoute('GET', $path, $controller, $middlewares);
    }

    public function post(string $path, array $controller, array $middlewares = []): void
    {
        $this->router->setRoute('POST', $path, $controller, $middlewares);
    }

    public static function resolveFilePath($path): string
    {
        return self::$ROOT_PATH . "{$path}.php";
    }

    public function registerGlobalMiddleware(mixed $middleware): void
    {
        $this->router->registerGlobalMiddleware($middleware);
    }
}