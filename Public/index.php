<?php

require_once "../config/Application.php";
define("BASE_PATH", Config\Application::BASE_PATH);

require_once BASE_PATH . '/vendor/autoload.php';
require_once "../App/Routes.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();