<?php

declare(strict_types=1);

function debug(mixed $data): void
{
    echo '<pre>';
    echo $data;
    echo '</pre>';

    die();
}