<?php

declare(strict_types=1);

use App\Config\Paths;
use App\Controllers\{AuthController, HomeController};
use App\Core\Application;
use App\Middlewares\{FlashMiddleware, SessionMiddleware, ValidateBodyMiddleware, ValidationExceptionMiddleware};
use App\Models\{SignInDtoModel, SignUpDtoModel};

require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'rootPath' => PATHS::ROOT,
    'globalMiddlewares' => [
        FlashMiddleware::class,
        SessionMiddleware::class,
        ValidationExceptionMiddleware::class,
    ]
];

$app = new Application($config);

// Home Page
$app->get('/', [HomeController::class, 'home']);

// Auth
$app->get('/sign-in', [AuthController::class, 'viewSignIn']);
$app->post('/sign-in', [AuthController::class, 'signIn'], [ValidateBodyMiddleware::with(SignUpDtoModel::class)]);
$app->get('/sign-up', [AuthController::class, 'viewSignUp']);
$app->post('/sign-up', [AuthController::class, 'signUp'], [ValidateBodyMiddleware::with(SignInDtoModel::class)]);

//

$app->run();