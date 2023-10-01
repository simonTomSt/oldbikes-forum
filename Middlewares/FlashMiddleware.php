<?php

namespace App\Middlewares;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Session;
use App\Core\View;

class FlashMiddleware implements MiddlewareInterface
{
    public function process(callable $next): void
    {

        View::addGlobalParam('errors', Session::get('errors'));
        Session::remove('errors');

        View::addGlobalParam('storedFormData', Session::get('storedFormData'));
        Session::remove('storedFormData');
        $next();
    }
}