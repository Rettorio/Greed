<?php

namespace App\Middleware;

use Core\Middleware\Middleware;
use Core\Router;
use Core\SessionManager;

Class AuthMiddleware implements Middleware {


    public function handler(callable $next, $args)
    {
        $auth = SessionManager::Auth();
        if(!$auth->ok) {
            Router::back("/login");
        }

        $next($args);
    }

}