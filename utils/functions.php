<?php

declare(strict_types=1);

use App\Config\Paths;

function resolvePartial(string $partialName)
{
    return Paths::TEMPLATES . "/partials/_{$partialName}.php";
}