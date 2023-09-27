<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    public function render(string $view, array $params = [], string $layout = null): void
    {
        echo View::renderView($view, $params, $layout);
    }
}