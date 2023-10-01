<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\DBModel;
use App\Core\Session;
use App\Exceptions\ValidationException;

class UserModel extends DBModel
{
    public function __construct()
    {
        parent::__construct('users');
    }

    public function createUser(array $userData): void
    {
        $password = password_hash($userData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $userData['password'] = $password;

        $this->create($userData);

        Session::regenerate();
        Session::set('user', $this->db->findLastCreatedId());
    }


    public function singUserIn(array $signInData): void
    {
        $user = $this->findOne(['username' => $signInData['username']]);

        $passwordsMatch = password_verify(
            $signInData['password'],
            $user['password'] ?? ''
        );

        if (!$user || !$passwordsMatch) {
            throw new ValidationException(['password' => 'Invalid credentials']);
        }

        Session::regenerate();
        Session::set('user', $user['id']);
    }

    public function signUserOut(): void
    {
        Session::remove('user');
        Session::regenerate();
    }
}