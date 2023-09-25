<?php

use Bramus\Router\Router;
use Pipeg\Suplos\helpers\Request;
use Pipeg\Suplos\controllers\AuthController;
use Pipeg\Suplos\controllers\CurrencyController;
use Pipeg\Suplos\controllers\EventController;
use Pipeg\Suplos\controllers\FamilyController;
use Pipeg\Suplos\controllers\SegmentsController;
use Pipeg\Suplos\controllers\TokenController;
use Pipeg\Suplos\models\Segments;

$dotenv = Dotenv\Dotenv::createImmutable("src/config");
$dotenv->load();

$router = new Router();

// Enviar los encabezados a todas las respuestas y rutas con el método GET|POST
$router->before('GET|POST', '/.*', function() {
    header('Access-Control-Allow-Origin: http://localhost:3000');
    header('Access-Control-Allow-Methods: GET, POST');
});

// Validamos el token

$router->before('GET|POST', '/client/.*', [TokenController::class, 'validHeaderToken']);

// Rutas

// Login
$router->post("/auth", [AuthController::class, 'login']);



// segments
$router->get("/client/segments", [SegmentsController::class, 'getAll']);
$router->get("/client/segments/(\d+)", function($id){ SegmentsController::getById($id);});
// Obtener las familias por id de segmento
$router->get("/client/segments/family", [FamilyController::class, 'getAll']);
$router->get("/client/segments/family/(\d+)", function($id){ FamilyController::getById($id);});
$router->get("/client/segments/(\d+)/family", function($id){ FamilyController::getByIdSegment($id);});
// Obtener las monedas registradas en la base de datos
$router->get("/client/currency", [CurrencyController::class, 'getAll']);
// Obtener y crear los eventos/ofertas
$router->get("/client/events", [EventController::class, 'getAll']);
$router->get("/client/events/(\d+)", function($id){ EventController::getById($id);});
$router->post("/client/events", [EventController::class, 'createEvent']);

$router->run();