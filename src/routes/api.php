<?php

use Bramus\Router\Router;
use Pipeg\Suplos\controllers\AuthController;

$dotenv = Dotenv\Dotenv::createImmutable("src/config");
$dotenv->load();

$router = new Router();

$router->before('GET|POST', '/.*', function() {
    header('Access-Control-Allow-Origin: http://localhost:3000');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Content-Type: application/json');
});

$router->get("/", function(){
    echo "Hi";
});

$router->post("/auth", [AuthController::class, 'login']);

$router->run();