<?php

declare(strict_types=1);

namespace App\Core;

class Session
{
    public static function start(array $cookieConfig): void
    {
        session_set_cookie_params($cookieConfig);

        session_start();
    }

    public static function regenerate(): void
    {
        session_regenerate_id();
    }

    public static function close(): void
    {
        session_write_close();
    }

    public static function isActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? false;
    }

    public static function getSession(): array
    {
        return $_SESSION;
    }

    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        session_destroy();
    }
}