<?php

use Bramus\Router\Router;
use Pipeg\Suplos\helpers\Request;
use Pipeg\Suplos\controllers\AuthController;
use Pipeg\Suplos\controllers\CurrencyController;
use Pipeg\Suplos\controllers\EventController;
use Pipeg\Suplos\controllers\FamilyController;
use Pipeg\Suplos\controllers\SegmentsController;
use Pipeg\Suplos\controllers\TokenController;
use Pipeg\Suplos\helpers\Response;

$dotenv = Dotenv\Dotenv::createImmutable("src/config");
$dotenv->load();

$router = new Router();

// Seteamos los cors headers
$router->before('GET|POST', '/.*', [Response::class, 'setHeadersCors']);
$router->options('/.*', [Response::class, 'setHeadersCors']);
// Validamos el token
$router->before('GET|POST', '/client/.*', [TokenController::class, 'validHeaderToken']);

// Rutas
// Login
$router->post("/auth", [AuthController::class, 'login']);
$router->get("/validToken", [AuthController::class, 'validateJwt']);

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
$router->post("/client/events", [EventController::class, 'createEvent']);
$router->get("/client/events/report", [EventController::class, 'getReportEvents']);
$router->get("/client/events/status", [EventController::class, 'updateStatusEvent']);
$router->get("/client/events/(\d+)", function($id){ EventController::getById($id);});
$router->post("/client/events/(\d+)/upload", function($id){ EventController::uploadDocument($id);});
$router->get("/client/events/(\d+)/documents", function($id){ EventController::getUploadDocuments($id);});


$router->run();