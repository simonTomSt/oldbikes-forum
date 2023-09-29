<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\DtoModel;

class SignUpDtoModel extends DtoModel
{
    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}