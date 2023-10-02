<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exception\NotFoundException;

class Router
{
    private readonly Request $request;
    private array $globalMiddlewares = [];
    private array $routes = [];


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setRoute(string $methodType, string $path, array $controller, array $middlewares = []): void
    {
        $this->routes[$methodType][$path]['controller'] = $controller;
        $this->routes[$methodType][$path]['middlewares'] = $middlewares;
    }

    public function registerGlobalMiddleware(mixed $middleware): void
    {
        $this->globalMiddlewares[] = $middleware;
    }

    public function resolve(): void
    {
        $route = $this->matchRoute();

        if (!$route) {
            throw new NotFoundException();
        }

        $controller = $route['controller'];
        $middlewares = $route['middlewares'];


        if (!isset($controller)) {
            throw new NotFoundException();
        }

        [$class, $function] = $controller;

        $action = fn() => (new $class)->{$function}($this->request);

        foreach ([...$middlewares, ...$this->globalMiddlewares] as $middleware) {
            $middlewareInstance = is_object($middleware) ? $middleware : (new $middleware);
            $action = fn() => $middlewareInstance->process($action);
        }

        $action();
    }

    function matchRoute()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $routeName => $route) {
            // Use named capturing group to capture the parameter value
            $pattern = preg_replace('#\{([a-z]+)\}#', '(?P<$1>[^/]+)', $routeName);
            $pattern = "@^" . $pattern . "$@D";

            if (preg_match($pattern, $url, $matches)) {
                // Extract named captures as parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                $this->request->setUrlParams($params);

                return $route;
            }
        }

        return false;
    }

}