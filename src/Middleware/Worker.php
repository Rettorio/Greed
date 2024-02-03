<?php

namespace Core\Middleware;

use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;

Class Worker {
    //list your own midleware here
    protected $list = [
        "auth" => AuthMiddleware::class,
        "auth:admin" => AdminMiddleware::class,
    ];

    protected $start;

    public function init(array $middlewares, callable $callback) :callable
    {
        $this->start = $this->innerWrap($callback);
        foreach($middlewares as $middleware) {
            $this->add(new $this->list[$middleware]);
        }

        return $this->start;
    }

    private function innerWrap($mainCallBack) :callable
    {
        $bi = new InnerMiddleware;
        return function($args) use ($bi, $mainCallBack) {
            return $bi->handler($mainCallBack, $args);
        };
    }

    private function add(Middleware $middleware)
    {
        $next = $this->start;

        $this->start = function($args) use ($middleware, $next) {
            return $middleware->handler($next, $args);
        };
    }
}