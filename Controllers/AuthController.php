<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{
    public function viewSignIn(): void
    {
        $this->render('sign-in', [], 'auth');
    }

    public function viewSignUp(): void
    {
        $this->render('sign-up', [], 'auth');
    }

    public function signIn(): void
    {
        echo $_POST['login'];
    }

    public function signUp(): void
    {
        echo $_POST['login'];
    }
}