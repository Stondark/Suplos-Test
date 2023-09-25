<?php

namespace Pipeg\Suplos\controllers;

use Exception;
use Pipeg\Suplos\helpers\Request;
use Pipeg\Suplos\helpers\Response;
use Pipeg\Suplos\models\Activities;
use Pipeg\Suplos\models\Currency;
use Pipeg\Suplos\models\Event;
use Pipeg\Suplos\models\EventSchedule;
use Pipeg\Suplos\models\Family;
use Pipeg\Suplos\models\Segments;
use Pipeg\Suplos\models\User;

class EventController{

    public static function getAll(){
        try {
            $segmentsData = Event::getAllEvents();
            if($segmentsData){
                return Response::statusCodeResponse(200)->sendResponseJson([], $segmentsData);
            }

            return Response::statusCodeResponse(400)->sendResponseJson([], [], "No encontramos información 
            en nuestra base de datos", false);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

    public static function getById(int|string $id){
        try {
            
            if(!is_numeric($id)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "Ingrese un valor númerico", false);
            }

            $familyData = Event::getByIdEvent(intval($id));
            if(is_null($familyData)){
                return Response::statusCodeResponse(400)->sendResponseJson([$id], [], "No se encontró un registro en la base de datos", false);
            }

            return Response::statusCodeResponse(200)->sendResponseJson([$id], $familyData);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);

        }
    }

    
    public static function createEvent(){
        try {
            $requestJson = Request::getJsonBody();

            if(!isset($requestJson["creator"]) && !isset($requestJson["family"]) && !isset($requestJson["segments"]) && !isset($requestJson["description"]) && !isset($requestJson["currency"]) && !isset($requestJson["object"]) && !isset($requestJson["budget"])){
                return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["The parameters must not be empty."], false);
            }
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
    
            if (!User::existUser($usernameCreator)) {
                return Response::statusCodeResponse(400)
                    ->sendResponseJson($requestJson, [], ["Username does not exist"],false);
            }
    
            $idCreator = User::getUser($usernameCreator)->getID();
    
            if(is_null(Currency::getAllCurrencyById($currency))){
                return Response::statusCodeResponse(400)
                    ->sendResponseJson($requestJson, [], ["This type of currency does not exist."],false);
            }
    
            if(is_null(Segments::getByIdSegments($segmentsId))){
                return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["This type of segment does not exist."],false);
            }
    
            if(is_null(Family::getByIdFamily($familyId))){
                return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["This type of family does not exist."],false);
            }
    
            $scheduleId = EventSchedule::saveSchedule($start_date, $start_time, $end_date, $end_time);
            if(is_null($scheduleId)){
                return Response::statusCodeResponse(400)
                ->sendResponseJson($requestJson, [], ["Fail to save the Schedule."],false);
            }

            $activitiesId = Activities::saveActivities($segmentsId, $familyId);
    
            $event = new Event();
            $event->idCreator = $idCreator;
            $event->idSchedule = $scheduleId;
            $event->idActivity = $activitiesId;
            $event->description = $description;
            $event->idCurrency = $currency;
            $event->object = $object;
            $event->budget = $budget;
            
            if($event->save()){
                return Response::statusCodeResponse(200)->sendResponseJson($requestJson);
            }
    
            return Response::statusCodeResponse(400)
            ->sendResponseJson($requestJson, [], ["Something went wrong during insertion"],false);
        } catch (Exception $e) {
            return Response::statusCodeResponse(400)->sendResponseJson([], [], $e->getMessage(), false);
        }
    }

}
