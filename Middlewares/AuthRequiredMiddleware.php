<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Session;

class AuthRequiredMiddleware implements MiddlewareInterface
{
    public function process(callable $next): void
    {
        if (empty(Session::get('user'))) {
            redirectTo('/sign-in');
        }

        $next();
    }
}