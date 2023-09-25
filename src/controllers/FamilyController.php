<?php

namespace Pipeg\Suplos\controllers;

use Exception;
use Pipeg\Suplos\helpers\Response;
use Pipeg\Suplos\models\Family;


class FamilyController{

    // Función estática para obtener todas las 'familias' en formato JSON
    public static function getAll(){
        try {
            $familyData = Family::getAllFamily();
            if($familyData){
                return Response::statusCodeResponse(200)->sendResponseJson([], $familyData);
            }

            return Response::statusCodeResponse(400)->sendResponseJson([], [], "No encontramos información 
            en nuestra base de datos", false);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

    // Función estática para obtener una 'familia' por su id en formato JSON
    public static function getById(int|string $id){
        try {
            
            if(!is_numeric($id)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "Ingrese un valor númerico", false);
            }

            $familyData = Family::getByIdFamily(intval($id));
            if(is_null($familyData)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "No se encontró un registro en la base de datos", false);
            }

            return Response::statusCodeResponse(200)->sendResponseJson([$id], $familyData);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

    // Función estática para obtener una 'familia' por su id de segmento relacionado en formato JSON
    public static function getByIdSegment(int|string $id){
        try {
            
            if(!is_numeric($id)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "Ingrese un valor númerico", false);
            }

            $familyData = Family::getByIdSegmentFamily(intval($id));
            if(is_null($familyData)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "No se encontró un registro en la base de datos", false);
            }

            return Response::statusCodeResponse(200)->sendResponseJson([$id], $familyData);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

}
