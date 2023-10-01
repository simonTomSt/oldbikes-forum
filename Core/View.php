<?php

namespace App\Core;

class View
{
    public static array $globalParams = [];

    public static function renderView(string $view, array $additionalData = [], string $layout = null): false|string
    {
        $params = array_map(fn(mixed $param): string => htmlspecialchars((string)$param), $additionalData);
        $globalParams = self::$globalParams;

        $pagePath = Application::resolveFilePath("templates/views/{$view}");
        $bodyPath = $layout ? Application::resolveFilePath("templates/layouts/{$layout}") : $pagePath;

        ob_start();

        include_once Application::resolveFilePath("templates/layouts/root");

        return ob_get_clean();
    }

    public static function addGlobalParam(string $key, mixed $value): void
    {
        self::$globalParams[$key] = $value;
    }

    public static function removeGlobalParam(string $key): void
    {
        unset(self::$globalParams[$key]);
    }
}