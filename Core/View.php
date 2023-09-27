<?php

namespace App\Core;

class View
{
    public static function renderView(string $view, array $additionalData = [], string $layout = null): false|string
    {
        $params = array_map(fn(mixed $param): string => htmlspecialchars((string)$param), $additionalData);

        $pagePath = Application::resolveFilePath("templates/views/{$view}");
        $bodyPath = $layout ? Application::resolveFilePath("templates/layouts/{$layout}") : $pagePath;
        ob_start();

        include_once Application::resolveFilePath("templates/layouts/root");

        return ob_get_clean();
    }
}