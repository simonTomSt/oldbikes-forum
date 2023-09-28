<?php

declare(strict_types=1);

function debug(mixed $data): void
{
    echo '<pre>';
    echo var_dump($data);
    echo '</pre>';

    die();
}

function redirectTo(string $path): void
{
    header("Location: {$path}");
    http_response_code(302);
    exit;
}