<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Model;
use App\Exceptions\ValidationException;


readonly class ValidateBodyMiddleware implements MiddlewareInterface
{
    public function __construct(private Model $model)
    {
    }

    public function process(callable $next): void
    {
        $this->validateWithModel();
        $errors = $this->model->errors;

        if (!empty($errors)) {
            throw new ValidationException($errors);
        }

        $next();
    }

    static public function with(string $model): ValidateBodyMiddleware
    {
        return new ValidateBodyMiddleware((new $model));
    }

    private function validateWithModel(): void
    {
        $formData = $_POST;
        $this->model->validate($formData);
    }
}