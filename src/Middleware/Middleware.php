<?php

namespace Core\Middleware;

interface Middleware {
    function handler(callable $next, array $args);
}