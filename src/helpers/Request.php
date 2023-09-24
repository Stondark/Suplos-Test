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


}