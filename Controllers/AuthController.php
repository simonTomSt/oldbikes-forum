<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\UserModel;

class AuthController extends Controller
{
    private readonly UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function viewSignIn(): void
    {
        $this->render('sign-in', [], 'auth');
    }

    public function viewSignUp(): void
    {
        $this->render('sign-up', [], 'auth');
    }

    public function signIn(Request $req): void
    {
        $formData = $req->getBody();

        $this->userModel->singUserIn($formData);
        redirectTo('/posts');
    }

    public function signUp(Request $req): void
    {
        $formData = $req->getBody();

        unset($formData['confirmPassword']);

        $this->userModel->createUser($formData);

        redirectTo('/posts');
    }

    public function singOut(): void
    {
        $this->userModel->signUserOut();

        redirectTo('/sign-in');
    }
}