<?php

namespace App\Middleware;

use Core\Middleware\Middleware;
use Core\Router;
use Core\SessionManager;

//I'll keep this class for middleware example feel fro to delet it
Class AdminMiddleware implements Middleware {


    public function handler(callable $next, $args)
    {
        $auth = SessionManager::Auth();
        if(!$auth->ok) {
            Router::back("/login");
        }
        $auth = $auth->body;
        if($auth->role !== "admin") {
            Router::forbiddenPage();
        }

        $next($args);
    }

}