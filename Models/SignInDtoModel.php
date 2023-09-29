<?php

declare(strict_types=1);


namespace App\Models;

use App\Core\DtoModel;

class SignInDtoModel extends DtoModel
{
    public function rules(): array
    {
        return [
            'login' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
        ];
    }
}