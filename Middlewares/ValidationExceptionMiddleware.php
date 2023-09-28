<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Core\Interfaces\MiddlewareInterface;
use App\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next): void
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $storedFormData = $_POST;

            $_SESSION['errors'] = $e->errors;
            $_SESSION['storedFormData'] = $storedFormData;

            $referer = $_SERVER['HTTP_REFERER'];
            redirectTo($referer);
        }
    }
}