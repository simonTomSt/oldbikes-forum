<?php

namespace App\Middlewares;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\View;

class FlashMiddleware implements MiddlewareInterface
{
    public function process(callable $next): void
    {

        View::addGlobalParam('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);

        View::addGlobalParam('storedFormData', $_SESSION['storedFormData']);
        unset($_SESSION['storedFormData']);

        $next();
    }
}