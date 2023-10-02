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


function generatePagination(int $totalCount, string $baseUrl, int $currentOffset, int $limit): void
{
    echo '<nav aria-label="Page navigation example"><ul class="pagination">';

    // Calculate the total number of pages
    $totalPages = ceil($totalCount / $limit);

    // Previous page link
    if ($currentOffset > 0) {
        echo '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?offset=' . max(0, $currentOffset - $limit) . '">Previous</a></li>';
    }

    // Generate page links
    for ($page = 1; $page <= $totalPages; $page++) {
        // Show the first 10 pages, then add three dots
        if ($page <= 10 || ($page >= ($currentOffset / $limit - 1) && $page <= ($currentOffset / $limit + 2)) || $page == $totalPages) {
            echo '<li class="page-item ' . ($page == ($currentOffset / $limit + 1) ? 'active' : '') . '"><a class="page-link" href="' . $baseUrl . '?offset=' . (($page - 1) * $limit) . '">' . $page . '</a></li>';
        } elseif ($page == 11) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }

    // Next page link
    if ($currentOffset < ($totalPages - 1) * $limit) {
        echo '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?offset=' . ($currentOffset + $limit) . '">Next</a></li>';
    }

    echo '</ul></nav>';
}


