<?php

namespace App\Core\Interfaces;

interface MiddlewareInterface
{
    public function process(callable $next): void;
}