<?php

namespace Pipeg\Suplos\controllers;

use Exception;
use Pipeg\Suplos\helpers\ExcelGenerator;
use Pipeg\Suplos\helpers\Request;
use Pipeg\Suplos\helpers\Response;
use Pipeg\Suplos\models\Activities;
use Pipeg\Suplos\models\Currency;
use Pipeg\Suplos\models\Event;
use Pipeg\Suplos\models\EventSchedule;
use Pipeg\Suplos\models\Family;
use Pipeg\Suplos\models\Segments;
use Pipeg\Suplos\models\User;
use Pipeg\Suplos\utils\ImagesUtils;

class EventController{

    // Función estática para obtener todos los 'eventos' en formato JSON
    public static function getAll(){
        try {
            $eventData = Event::getAllEvents();
            if($eventData){
                return Response::statusCodeResponse(200)->sendResponseJson([], $eventData);
            }

            return Response::statusCodeResponse(400)->sendResponseJson([], [], "We did not find information
            in our database", false);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

    // Función estática para obtener un 'evento' por su id en formato JSON
    public static function getById(int|string $id){
        try {
            
            if(!is_numeric($id)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "Ingrese un valor númerico", false);
            }

            $familyData = Event::getByIdEvent(intval($id));
            if(is_null($familyData)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "We did not find information
            in our database", false);
            }

            return Response::statusCodeResponse(200)->sendResponseJson([$id], $familyData);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

    // Función estática para llamar al modelo para crear un evento
    public static function createEvent(){
        try {
            $requestJson = Request::getJsonBody();

            // Validamos que el json/array proveniente de la peticicón contenga estos valores, en caso de que no retornamos un 400
            if(!isset($requestJson["creator"]) && !isset($requestJson["family"]) && !isset($requestJson["segments"]) && !isset($requestJson["description"]) && !isset($requestJson["currency"]) && !isset($requestJson["object"]) && !isset($requestJson["budget"])){
                return Response::statusCodeResponse(400)
                ->sendResponseJson(array($requestJson), [], ["The parameters must not be empty."], false);
            }

            // Asignamos todos los valores a las siguientes variabls
            $usernameCreator = $requestJson["creator"];
            $familyId = $requestJson["family"];
            $segmentsId = $requestJson["segments"];
            $description = htmlspecialchars($requestJson["description"]);
            $currency = $requestJson["currency"];
            $object = $requestJson["object"];
            $budget = $requestJson["budget"];
            $start_date = $requestJson["start_date"];
            $start_time = $requestJson["start_time"];
            $end_date = $requestJson["end_date"];
            $end_time = $requestJson["end_time"];
    

            // Validamos que el usuario creador exista en la base de datos
            if (!User::existUser($usernameCreator)) {
                return Response::statusCodeResponse(400)
                    ->sendResponseJson($requestJson, [], ["Username does not exist"],false);
            }
            // En caso de que exista obtenemos el usuario y su ID
            $idCreator = User::getUser($usernameCreator)->getID();

            // Validamos el identificador (objeto) que recibimos

            if(!is_null(Event::getByObject($object))){
                return Response::statusCodeResponse(400)
                    ->sendResponseJson($requestJson, [], ["The object already exist."],false);
            }

            // Validamos que el tipo de moneda en la petición exista
            if(is_null(Currency::getAllCurrencyById($currency))){
                return Response::statusCodeResponse(400)
                    ->sendResponseJson($requestJson, [], ["This type of currency does not exist."],false);
            }
    
            //Validamos que el idSegmento exista en la base de datos
            if(is_null(Segments::getByIdSegments($segmentsId))){
                return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["This type of segment does not exist."],false);
            }
    
            //Validamos que el idFamilia exista en la base de datos
            if(is_null(Family::getByIdFamily($familyId))){
                return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["This type of family does not exist."],false);
            }
            // Validamos que la relación sea válida
            if(is_null(Activities::validActivities($segmentsId, $familyId))){
                return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["This is not a valid activity."],false);
            }

            $activitiesId = Activities::getIdActivities($segmentsId, $familyId);
            // Validamos que si no existe esa combinación de actividad, la guardamos
            if(is_null($activitiesId)){
                $activitiesId = Activities::saveActivities($segmentsId, $familyId);
            }

            // Guardamos el cronograma en la base de datos y validamos que se haya guardado correctamente
            // e igualmente en caso de ser éxitoso, obtenemos el id devuelto para añadirlo como relación
            $scheduleId = EventSchedule::saveSchedule($start_date, $start_time, $end_date, $end_time);
            if(is_null($scheduleId)){
                return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["Fail to save the Schedule."],false);
            }

            // Asignamos todos los valores al nuevo objeto de Event
            $event = new Event();
            $event->idCreator = $idCreator;
            $event->idSchedule = $scheduleId;
            $event->idActivity = $activitiesId;
            $event->description = $description;
            $event->idCurrency = $currency;
            $event->object = $object;
            $event->budget = $budget;
            // Validamos que se haya guardado el valor en la base de datos
            if($event->save()){
                return Response::statusCodeResponse(200)->sendResponseJson($requestJson);
            }
            // En caso de que no se haya guardado el valor en la base de datos
            return Response::statusCodeResponse(400)
            ->sendResponseJson($requestJson, [], ["Something went wrong during insertion"],false);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);
        }
    }

    public static function uploadDocument(int|string $id){
        try {
            $eventData = Event::getByIdEvent(intval($id));
            if(is_null($eventData)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "We did not find information
                in our database", false);
            }
    
            $files = Request::getFiles('document');
            $moveFile = ImagesUtils::storeFile($files);
    
            if(!$moveFile){
                return Response::statusCodeResponse(400)->sendResponseJson([$files], [], "Failure to obtain document.", false);
            }

            $saveRecordFile = Event::saveDocumentEvent($id, $moveFile);
            if($saveRecordFile){
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                $urlFile = $protocol . $_SERVER['HTTP_HOST'] . "/" . $moveFile;
                return Response::statusCodeResponse(200)->sendResponseJson([], ["url" => $urlFile]);
            }

        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([$files], [], $e->getMessage(), false);
        }
    }

    public static function getUploadDocuments(int|string $id){
        try {
            $routeFiles = Event::getDocumentEvent($id);
            if(is_null($routeFiles)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "We did not find information
                in our database", false);
            }
            $urlsArray = [];
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            foreach ($routeFiles as $key => $value) {
                $urlsArray[] = $protocol . $_SERVER['HTTP_HOST'] . "/" . $value["route_doc"];
            }
            
            if(count($urlsArray) >= 1){
                return Response::statusCodeResponse(200)->sendResponseJson([$id], $urlsArray);
            }

            return Response::statusCodeResponse(400)->sendResponseJson([$id], [], 'Fail to create url docs.', false);            

        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([$id], [], $e->getMessage(), false);
        }
    }

    public static function updateStatusEvent(){
        try {
            $allEvents = Event::getAllScheduleEvents();
            if(is_null($allEvents)){
                return Response::statusCodeResponse(400)->sendResponseJson([], [], 'There is no event that meets the conditions.', false);            
            }
            $eventsUpdate = 0;
            $totalEvents = 0;
            foreach ($allEvents as $key => $value) {
                $totalEvents++;
                $resultUpdate = Event::updateScheduleEvent($value["estado"], $value["id"]);
                if($resultUpdate){
                    $eventsUpdate++;
                }
            }
    
            if($totalEvents != $eventsUpdate){
                return Response::statusCodeResponse(400)->sendResponseJson([], ["totalEvents" => $totalEvents, "eventsUpdate" => $eventsUpdate], 'Fail to update all events status', false);            
            }
    
            return Response::statusCodeResponse(200)->sendResponseJson([], ["totalEvents" => $totalEvents, "eventsUpdate" => $eventsUpdate]);
    
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
        
    }


    public static function getReportEvents(){
        $now = date("Y-m-d-H-i-s");
        $reportName = "Events-Report-$now";
        $excel = new ExcelGenerator($reportName);
        $headers = [];
        $data = Event::getAllEvents();
        if(!$data){
            return Response::statusCodeResponse(400)->sendResponseJson([], [], "We did not find information
            in our database", false);
        }

        foreach ($data[0] as $key => $value) {
            $headers[] = $key;
        } 

        $excel->setHeaders($headers)->writeInfoFromArray($data);
        $fileExcel = $excel->saveFile();
        if($fileExcel["success"]){
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            $urlFile = $protocol . $_SERVER['HTTP_HOST'] . "/" . $fileExcel["route"];
            return Response::statusCodeResponse(200)->sendResponseJson([], ["url" => $urlFile, "message" => $fileExcel["message"]]);
        }

        return Response::statusCodeResponse(400)->sendResponseJson([], [], $fileExcel["message"], false);


    }


}
