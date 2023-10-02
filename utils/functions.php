<?php

declare(strict_types=1);

use App\Config\Paths;

function resolvePartial(string $partialName): string
{
    return Paths::TEMPLATES . "/partials/_{$partialName}.php";
}

function generateInputField($params): void
{
    $name = $params['name'];
    $label = $params['label'] ?? ucfirst($name);
    $type = $params['type'] ?? 'text';
    $value = $params['value'] ?? '';
    $required = isset($params['required']) && $params['required'] ? 'required' : '';
    $errorMessage = $params['errorMessage'] ?? false;

    echo "<label for=\"$name\" class=\"form-label\">$label</label>";

    if ($type === 'textarea') {
        echo "<textarea id=\"$name\" name=\"$name\" $required class=\"form-control" . ($errorMessage ? ' is-invalid' : '') . "\">$value</textarea>";
    } else {
        echo "<input value=\"$value\" type=\"$type\" id=\"$name\" name=\"$name\" $required class=\"form-control" . ($errorMessage ? ' is-invalid' : '') . "\" >";
    }

    if ($errorMessage) {
        echo "<div class=\"invalid-feedback\">$errorMessage</div>";
    }
}
