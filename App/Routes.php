<?php

use App\Controller\AuthController;
use Core\Router;

$paramRules = [
    "id" => "numeric",
];

$router = new Router($paramRules);

$router->get("/test/{name}", function($name) {
    echo "<br>Hello nama saya $name";
});

$router->get("/login", [AuthController::class, "Lo  ginPage"]);
$router->get("/register", [AuthController::class, "RegisterPage"]);
$router->get("/logout", [AuthController::class, "Logout"]);

$router->post("/login", [AuthController::class, "Login"]);
$router->post("/register", [AuthController::class, "Register"]);

$router->dispatch();