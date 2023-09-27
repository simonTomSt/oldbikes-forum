<?php

declare(strict_types=1);

use App\Config\Paths;
use App\Controllers\{AuthController, HomeController};
use App\Core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'rootPath' => PATHS::ROOT,
];

$app = new Application($config);


$app->get('/', [HomeController::class, 'home']);
$app->get('/sign-in', [AuthController::class, 'viewSignIn']);
$app->get('/sign-up', [AuthController::class, 'viewSignUp']);

$app->run();