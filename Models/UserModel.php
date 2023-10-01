<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\DBModel;
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

        session_regenerate_id();

        $_SESSION['user'] = $this->db->findLastCreatedId();
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

        session_regenerate_id();

        $_SESSION['user'] = $user['id'];
    }
}