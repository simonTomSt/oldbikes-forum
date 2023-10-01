<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Session;
use App\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next): void
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $storedFormData = $_POST;

            Session::set('errors', $e->errors);
            Session::set('storedFormData', $storedFormData);

            $referer = $_SERVER['HTTP_REFERER'];
            redirectTo($referer);
        }
    }
}