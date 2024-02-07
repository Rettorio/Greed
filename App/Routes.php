<?php

use App\Controller\AuthController;
use Core\Router;
use Core\View;

$paramRules = [
    "id" => "numeric",
];

$router = new Router($paramRules);

$router->get("/", function() {
    View::render('welcome', [], false);
});

$router->get("/login", [AuthController::class, "LoginPage"]);
$router->get("/register", [AuthController::class, "RegisterPage"]);
$router->get("/logout", [AuthController::class, "Logout"]);

$router->post("/login", [AuthController::class, "Login"]);
$router->post("/register", [AuthController::class, "Register"]);

$router->dispatch();