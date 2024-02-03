<?php

require_once "../config/Application.php";
define("BASE_PATH", Config\Application::BASE_PATH);

require_once BASE_PATH . '/vendor/autoload.php';
require_once "../App/Routes.php";

//define const application_path


// var_dump(parse_url($_SERVER['REQUEST_URI'])['path']);
?>