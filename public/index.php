<?php

declare(strict_types=1);

use App\Config\Paths;
use App\Controllers\{HomeController};
use App\Core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'rootPath' => PATHS::ROOT,
];

$app = new Application($config);


$app->get('/', [HomeController::class, 'home']);

$app->run();