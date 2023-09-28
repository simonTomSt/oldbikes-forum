<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exception\NotFoundException;

class Router
{
    private readonly Request $request;
    private readonly array $globalMiddlewares;
    protected array $routes = [];


    public function __construct(Request $request, array $globalMiddlewares = [])
    {
        $this->request = $request;
        $this->globalMiddlewares = $globalMiddlewares;
    }

    public function setRoute(string $methodType, string $path, array $controller, array $middlewares = []): void
    {
        $this->routes[$methodType][$path]['controller'] = $controller;
        $this->routes[$methodType][$path]['middlewares'] = $middlewares;
    }

    public function resolve(): void
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $controller = $this->routes[$method][$path]['controller'];
        $middlewares = $this->routes[$method][$path]['middlewares'];

        if (!isset($controller)) {
            throw new NotFoundException();
        }

        [$class, $function] = $controller;

        $action = fn() => (new $class)->{$function}();

        foreach ([...$middlewares, ...$this->globalMiddlewares] as $middleware) {
            $middlewareInstance = is_object($middleware) ? $middleware : (new $middleware);
            $action = fn() => $middlewareInstance->process($action);
        }

        $action();
    }
}