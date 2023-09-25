<?php

namespace Pipeg\Suplos\controllers;

use Exception;
use Pipeg\Suplos\helpers\Response;
use Pipeg\Suplos\models\Currency;


class CurrencyController{

    public static function getAll(){
        try {
            $currencyData = Currency::getAllCurrency();
            if($currencyData){
                return Response::statusCodeResponse(200)->sendResponseJson([], $currencyData);
            }
            
            return Response::statusCodeResponse(400)->sendResponseJson([], [], "No encontramos información 
            en nuestra base de datos", false);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

}
