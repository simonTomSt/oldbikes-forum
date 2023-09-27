<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{
    public function viewSignIn()
    {
        $this->render('sign-in', [], 'auth');
    }

    public function viewSignUp()
    {
        $this->render('sign-up', [], 'auth');
    }
}