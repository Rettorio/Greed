<?php

namespace Core\Middleware;

/**
 * 
 * This is the deepest layer of middleware you would notice that at the bottom of the handler method
 * it has different call function due to CALLBACK ARGUMENT ORDER (assoc aray)  
 * 
 */

Class InnerMiddleware implements Middleware {


    public function handler(callable $next, $args)
    {
        // $next($args);
        call_user_func_array($next, $args);
    }
}