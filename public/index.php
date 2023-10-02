<?php

declare(strict_types=1);

use App\Config\AppConfiguration;
use App\Controllers\{AuthController, HomeController, PostsController};
use App\Core\Application;
use App\Middlewares\{AuthRequiredMiddleware,
    FlashMiddleware,
    SessionMiddleware,
    ValidateBodyMiddleware,
    ValidationExceptionMiddleware};
use App\Models\{SignInDtoModel, SignUpDtoModel};

require_once __DIR__ . '/../vendor/autoload.php';

$config = new AppConfiguration();

// New app
$app = new Application($config->getConfig());

// Global middlewares
$app->registerGlobalMiddleware(FlashMiddleware::class);
$app->registerGlobalMiddleware(SessionMiddleware::class);
$app->registerGlobalMiddleware(ValidationExceptionMiddleware::class);

// Home page
$app->get('/', [HomeController::class, 'home']);

// Auth
$app->get('/sign-in', [AuthController::class, 'viewSignIn']);
$app->post('/sign-in', [AuthController::class, 'signIn'], [ValidateBodyMiddleware::with(SignInDtoModel::class)]);
$app->get('/sign-up', [AuthController::class, 'viewSignUp']);
$app->post('/sign-up', [AuthController::class, 'signUp'], [ValidateBodyMiddleware::with(SignUpDtoModel::class)]);
$app->get('/sign-out', [AuthController::class, 'singOut'], [AuthRequiredMiddleware::class]);

// Posts
$app->get('/posts', [PostsController::class, 'viewPosts'], [AuthRequiredMiddleware::class]);
$app->get('/create-post', [PostsController::class, 'viewCreatePost'], [AuthRequiredMiddleware::class]);
$app->post('/create-post', [PostsController::class, 'createPost'], [AuthRequiredMiddleware::class]);
$app->get('/my-posts', [PostsController::class, 'viewUserPosts'], [AuthRequiredMiddleware::class]);

// Run
$app->run();