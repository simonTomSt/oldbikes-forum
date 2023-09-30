<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\DBModel;

class UserModel extends DBModel
{
    public function __construct()
    {
        parent::__construct('users');
    }
}