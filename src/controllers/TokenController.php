<?php

namespace Pipeg\Suplos\controllers;

use LogicException;
use Pipeg\Suplos\helpers\Request;
use Pipeg\Suplos\helpers\Response;
use Pipeg\Suplos\utils\TokenGenerator;
use UnexpectedValueException;

class TokenController{

    public static function validHeaderToken(){
        $token = Request::getAuthToken();
        if(is_null($token)){
            Response::statusCodeResponse(401)->sendResponseJson([], [], "Please enter an authorization token", false);
            exit();
        }
        
        try {
            TokenGenerator::validateToken($token);
        } catch (LogicException $e) {
            Response::statusCodeResponse(400)->sendResponseJson(["token" => $token], [], $e->getMessage(), false);
            exit();
        } catch (UnexpectedValueException $e){
            Response::statusCodeResponse(400)->sendResponseJson(["token" => $token], [], $e->getMessage(), false);
            exit();
        }
    }

}