<?php

namespace Pipeg\Suplos\helpers;


class Response{

    private static int $statusCode;


    public static function setHeadersCors(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
    }

    public static function statusCodeResponse(int $statusCode) : self{
        self::$statusCode = $statusCode;
        return new self();
    }

    public static function sendResponseJson(array $parameters, array $data = [], array|string $descError = [], bool $success = true) : void {
        $dataResponse["parameters"] = $parameters;
        $dataResponse["data"] = $data;
        $dataResponse["success"] = $success;
        http_response_code(self::$statusCode);
        header('Content-Type: application/json');
        // En caso de querer retornar un error o excepción
        if (!empty($descError) ) {
            $dataResponse["message"] = $descError;
        }
        echo json_encode($dataResponse);
    }
   

}