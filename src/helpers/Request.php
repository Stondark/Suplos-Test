<?php

namespace Pipeg\Suplos\helpers;

class Request{

    public static function getBody() : string|false {
        return file_get_contents('php://input');
    }
   
    public static function getJsonBody() : mixed{
        return json_decode(self::getBody(), true);
    }

    public static function getHeaders() : array{
        return getallheaders();
    }

    public static function getFiles(string $param) : array|null{
        if(!isset($_FILES[$param])){
            return NULL;
        }
        return $_FILES[$param];
    }

    public static function getAuthToken() : null|string{
        $headers = self::getHeaders();
        if(!isset($headers["Authorization"])){
            return null;
        }
        $authHeader = $headers["Authorization"];

        return explode(" ", $authHeader)[1];
    }


}