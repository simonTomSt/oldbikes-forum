<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Session;
use App\Core\View;
use App\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next): void
    {
        if (Session::isActive()) {
            throw new SessionException("Session already active.");
        }

        if (headers_sent($filename, $line)) {
            throw new SessionException("Headers already sent. Consider enabling output buffering. Data outputted from {$filename} - Line: {$line}");
        }

        Session::start([
            'secure' => $_ENV['APP_ENV'] === "production",
            'httponly' => true,
            'samesite' => 'lax'
        ]);

        View::addGlobalParam('session', Session::getSession());

        $next();

        Session::close();
        View::removeGlobalParam('session');

    }
}