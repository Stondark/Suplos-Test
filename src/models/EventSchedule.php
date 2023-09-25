<?php
namespace Pipeg\Suplos\models;

use Exception;
use PDOException;
use PDO;
use Pipeg\Suplos\db\Database;
use Pipeg\Suplos\utils\DateUtils;

class EventSchedule{

    public static function saveSchedule($start_date, $start_time, $end_date, $end_time) : null|int{
        try {
            $fullStartDate = DateUtils::generateDatetime($start_date, $start_time);
            $fullEndDate = DateUtils::generateDatetime($end_date, $end_time);
            $db = new Database();
            $pdo = $db->connect();
            $query = $pdo->prepare("INSERT INTO `event_offers_schedule` (`id`, `start_date`, `start_time`, `end_date`, `end_time`, `full_start_date`, `full_end_date`) 
            VALUES (NULL, :start_date, :start_time, :end_date, :end_time, :full_start, :full_end)");
            $query->execute(["start_date" => $start_date,
                            "start_time" => $start_time,
                            "end_date" => $end_date,
                            "end_time" => $end_time,
                            "full_start" => $fullStartDate,
                            "full_end" => $fullEndDate]);
            return $pdo->lastInsertId();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } catch(PDOException $e){
            throw new PDOException($e);
        }
        
    }


}