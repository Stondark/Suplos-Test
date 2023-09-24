<?php

namespace Pipeg\Suplos\helpers;


class Response{

    private static int $statusCode;

    public static function statusCodeResponse(int $statusCode) : self{
        self::$statusCode = $statusCode;
        return new self();
    }

    public static function sendResponseJson(array $parameters, array $data = [], array $descError = []) : void {
        $dataResponse["parameters"] = $parameters;
        $dataResponse["data"] = $data;
        http_response_code(self::$statusCode);
        // En caso de querer retornar un error o excepción
        if (!empty($descError) ) {
            $dataResponse["message"] = $descError;
        }
        echo json_encode($dataResponse);
    }
   

}