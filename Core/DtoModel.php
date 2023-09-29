<?php

namespace App\Core;

class DtoModel
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';
    const RULE_MIN = 'min';
    const RULE_MAX = 'max';
    const RULE_MATCH = 'match';
    const RULE_UNIQUE = 'unique';

    public array $errors = [];

    public function rules(): array
    {
        return [];
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'Record with with this {field} already exists',
        ];
    }

    public function getErrorMessage($rule): string
    {
        return $this->errorMessages()[$rule];
    }

    public function validate(array $bodyData): void
    {
        foreach ($this->rules() as $fieldName => $fieldRules) {
            $fieldValue = $bodyData[$fieldName];

            foreach ($fieldRules as $fieldRule) {
                $ruleName = $fieldRule[0];

                if ($ruleName === self::RULE_REQUIRED && !$fieldValue) {
                    $this->addError($fieldName, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($fieldName, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($fieldValue) < $fieldRule['min']) {
                    $this->addError($fieldName, self::RULE_MIN, ['min' => $fieldRule['min']]);
                }
                if ($ruleName === self::RULE_MAX && strlen($fieldValue) > $fieldRule['max']) {
                    $this->addError($fieldName, self::RULE_MAX);
                }
                if ($fieldRule === self::RULE_MATCH && $fieldValue !== $this->{$fieldRule['match']}) {
                    $this->addError($fieldName, self::RULE_MATCH, ['match' => $fieldRule['match']]);
                }
            }
        }
    }

    protected function addError(string $fieldName, string $rule, $params = []): void
    {
        $errorMessage = $this->getErrorMessage($rule);

        foreach ($params as $key => $value) {
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }

        $this->errors[$fieldName] = $errorMessage;
    }
}