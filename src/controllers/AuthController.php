<?php

namespace Pipeg\Suplos\controllers;

use Pipeg\Suplos\helpers\Request;
use Pipeg\Suplos\models\User;
use Pipeg\Suplos\helpers\Response;
use Pipeg\Suplos\utils\TokenGenerator;
use UnexpectedValueException;
use LogicException;

class AuthController
{

    public static function login()
    {
        $requestJson = Request::getJsonBody();

        // Validamos que el json que recibimos contiene estos dos valores
        if (!isset($requestJson["username"]) && !isset($requestJson["password"])) {
            return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["The parameters must not be empty."], false);
        }

        // Obtenemos los valores con los que validaremos el usuario
        $username = $requestJson["username"];
        $password = $requestJson["password"];

        // Validamos que el usuario exista en la base de datosmediante el nombre de usuario
        if (!User::existUser($username)) {
            return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["Username does not exist"],false);
        }
        
        // Obtenemos la información del usuario y la comparamos con la guardada en la base de datos
        $user = User::getUser($username);
        if(!$user->comparePassword($password)){
            return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["Password does not match"], false);
        }

        // Creamos el JWT pasándole como payload el username
        $token = TokenGenerator::generateToken($username);
        return Response::statusCodeResponse(200)->sendResponseJson([], ["token" => $token]);
    }

    public static function validateJwt(){
        // Obtenemos el token guardado en el header de la petición
        $token = Request::getAuthToken();

        if(is_null($token)){
            Response::statusCodeResponse(401)->sendResponseJson([], [], "Please enter an authorization token", false);
            exit();
        }
        
        // Validamos la validez del token en la petición
        try {
            TokenGenerator::validateToken($token);
            Response::statusCodeResponse(200)->sendResponseJson(["token" => $token], [], []);
        } catch (LogicException $e) {
            Response::statusCodeResponse(400)->sendResponseJson(["token" => $token], [], $e->getMessage(), false);
            exit();
        } catch (UnexpectedValueException $e){
            Response::statusCodeResponse(400)->sendResponseJson(["token" => $token], [], $e->getMessage(), false);
            exit();
        }
    }
}
