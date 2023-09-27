<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exception\NotFoundException;

class Router
{
    private readonly Request $request;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function setRoute(string $methodType, string $path, array $controller): void
    {
        $this->routes[$methodType][$path] = $controller;
    }


    public function resolve(): void
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $controller = $this->routes[$method][$path];


        if (!isset($controller)) {
            throw new NotFoundException();
        }

        [$class, $function] = $controller;

        $action = fn() => (new $class)->{$function}();

        foreach ($this->middlewares as $middleware) {
            $action = fn() => (new $middleware)->process($action);
        }

        $action();
    }
}