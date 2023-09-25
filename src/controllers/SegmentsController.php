<?php

namespace Pipeg\Suplos\controllers;

use Exception;
use Pipeg\Suplos\helpers\Response;
use Pipeg\Suplos\models\Segments;


class SegmentsController{

    // Función estática para obtener todos los 'segmentos' en formato JSON
    public static function getAll(){
        try {
            $segmentsData = Segments::getAllSegments();
            if($segmentsData){
                return Response::statusCodeResponse(200)->sendResponseJson([], $segmentsData);
            }

            return Response::statusCodeResponse(400)->sendResponseJson([], [], "No encontramos información 
            en nuestra base de datos", false);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

    // Función estática para obtener un 'segmento' por su id en formato JSON
    public static function getById(int|string $id){
        try {
            
            if(!is_numeric($id)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "Ingrese un valor númerico", false);
            }

            $segmentsData = Segments::getByIdSegments(intval($id));
            if(is_null($segmentsData)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "No se encontró un registro en la base de datos", false);
            }

            return Response::statusCodeResponse(200)->sendResponseJson([$id], $segmentsData);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

}
