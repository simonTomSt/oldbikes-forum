<?php

declare(strict_types=1);

namespace App\Config;

use Dotenv\Dotenv;

class  AppConfiguration
{
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(Paths::ROOT);
        $dotenv->load();
    }

    public function getConfig(): array
    {
        return [
            'rootPath' => PATHS::ROOT,
            'db' => [
                'dsn' => $_ENV['DB_DSN'],
                'username' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
            ]];
    }
}