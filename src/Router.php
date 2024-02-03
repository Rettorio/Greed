<?php

namespace Core;

use Core\Middleware\Worker;
use ReflectionFunction;
use ReflectionMethod;

Class Router {
    private $routes = [];

    const GET_METHOD = 'GET';
    const POST_METHOD = 'POST';

    protected $paramRules;

    protected $uri;

    protected $listRoute;


    public function __construct(array $paramRules)
    {
        $this->paramRules = $paramRules;
        $this->uri = parse_url($_SERVER['REQUEST_URI']);
    }

    public function get(string $url, callable|array $callback) :Router
    {
        $method = "GET";
        $middleware = [];
        array_push($this->routes, compact('method','url','callback', 'middleware'));

        return $this;
    }

    public function post(string $url, callable|array $callback) :Router
    {
        $method = "POST";
        $middleware = [];
        array_push($this->routes, compact('method', 'url', 'callback', 'middleware'));

        return $this;
    }

    public function middleware(array $name)
    {
        $latestRoute = array_pop($this->routes);
        //add new middleware
        array_push($latestRoute["middleware"], ...$name);
        //push back
        array_push($this->routes, $latestRoute);
    }

    private function getController(string $magic)
    {
        //separate the actual controller and method from the string
        list($controller, $action) = explode('@', $magic);
        return [
            'name' => $controller,
            'action' => $action
        ];
    }
    
    private function resolve(string $uri, $method, bool $argsUrl) :bool
    {
        $requestPath = $this->uri['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if($argsUrl) {
            return strpos($requestPath, $uri) !== false && $requestMethod === $method;
        }
        if($requestPath === $uri && $requestMethod === $method) {
            return true;
        }
        return false;
    }

    static public function back(string $path = "")
    {
        $base = empty($path) ? $_SERVER['HTTP_REFERER'] : $path;
        header("Location: {$base}");
        exit(0);
    }

    static public function noPage() :void
    {
        View::render('errorPage.404', [], false);
        exit(0);
    }

    static public function forbiddenPage() :void
    {
        View::render('errorPage.403', [], false);
        exit(0);
    }

    protected function extractParam($indexParam, $paramName) :string
    {
        $requestPath = $this->uri['path'];
        $requestPath = explode("/", $requestPath);
        $vals = $this->paramValidation($paramName, $requestPath[$indexParam]);
        return $vals;
    }

    protected function paramValidation(string $name, $value)
    {
        //apply param validation if rule by paramName exist!
        @$rule = $this->paramRules[$name];
        if(!empty($rule)) {
            switch($rule) {
                case 'numeric' :
                    $num = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    if(!is_numeric($value) && !$num) {
                        $this->back();
                        return;
                    }
                    return $num;
                default :
                    return filter_var($value, FILTER_SANITIZE_URL);
            }
        }
        return filter_var($value, FILTER_SANITIZE_URL);
    }

    protected function checkRequestParam(array|callable $handler) :bool
    {
        //handler[0] => controller, handler[1] => method
        $reflect = is_array($handler) ? new ReflectionMethod($handler[0], $handler[1]) : new ReflectionFunction($handler);
        foreach($reflect->getParameters() as $arg) {
            if($arg->name === "request") {return true;};
        }
        return false;
    }

    public function dispatch()
    {
        $handler = null;
        $args = [];
        $hasMiddle = [];
        foreach($this->routes as $route) {
            extract($route);
            $rr = explode("/", $url);
            preg_match('/{(.*)}/', $url, $matches);
            $hasParam = !empty($matches);
            if($hasParam) {
                $paramIndex = array_search($matches[0], $rr);
                $url = str_replace($matches[0], "", $url);
            }
            //$m = method, $c = controller
            if($this->resolve($url, $method, $hasParam)) {
                @$handler = $callback;
                //check whether the route have parameter to pass or not
                if($hasParam) {
                    $keyName = $matches[1];
                    $args[$keyName] = $this->extractParam($paramIndex, $keyName);
                }
                $hasMiddle = $middleware;
            }
        }
        if (is_null($handler)) {
            self::noPage();
        }
        $request = new Request($_POST, $_FILES, $_GET);
        if ($this->checkRequestParam($handler)) {
            $args['request'] = $request;
        }
        switch (true) {
            //middleware defined in route
            case !empty($hasMiddle):
                $worker = new Worker;
                call_user_func($worker->init($hasMiddle, $handler), $args);
                break;
            //callback had argument to fulfill
            case !empty($args):
                call_user_func_array($handler, $args);
                break;
            default:
                call_user_func($handler);
                break;
        }
    }
    
}