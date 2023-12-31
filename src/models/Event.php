<?php

namespace Pipeg\Suplos\models;

use Pipeg\Suplos\db\Database;
use PDO;
use PDOException;

class Event
{

    public int $idCreator;
    public int $idStatus = 1;
    public int $idActivity;
    public int $idCurrency;
    public int $idSchedule;
    public string $description;
    public string $object;
    public string $budget;

    public static function getAllEvents()
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare(
                "SELECT eo.id, u.username, eos.full_start_date, eo.description, eos.full_end_date, sta.status, eo.object, eo.budget, 
                seg.description_segment, fam.description_family, cur.currency_type 
                FROM event_offers eo 
                INNER JOIN users u ON u.id_user = eo.id_creator 
                LEFT JOIN event_offers_schedule eos ON eos.id = eo.id_event_offers_schedule 
                INNER JOIN activities act ON eo.id_activity = act.id 
                INNER JOIN segments seg ON act.id_segments = seg.id 
                INNER JOIN family fam ON act.id_family = fam.id 
                INNER JOIN status sta ON sta.id = eo.id_status 
                INNER JOIN currency cur ON cur.id = eo.id_currency"
            );
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public static function getByObject(string $object)
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare(
                "SELECT eo.id, u.username, eos.full_start_date, eo.description, eos.full_end_date, sta.status, eo.object, eo.budget, 
                seg.description_segment, fam.description_family, cur.currency_type 
                FROM event_offers eo 
                INNER JOIN users u ON u.id_user = eo.id_creator 
                LEFT JOIN event_offers_schedule eos ON eos.id = eo.id_event_offers_schedule 
                INNER JOIN activities act ON eo.id_activity = act.id 
                INNER JOIN segments seg ON act.id_segments = seg.id 
                INNER JOIN family fam ON act.id_family = fam.id 
                INNER JOIN status sta ON sta.id = eo.id_status 
                INNER JOIN currency cur ON cur.id = eo.id_currency
                WHERE eo.object = :object"
            );
            $query->execute(["object" => $object]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return null;
            }
            return $data;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public static function getByIdEvent(string $id)
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare(
                "SELECT eo.id, u.username, eos.full_start_date, eos.full_end_date, eo.description, sta.status, eo.object, eo.budget, 
                seg.description_segment, fam.description_family, cur.currency_type 
                FROM event_offers eo 
                INNER JOIN users u ON u.id_user = eo.id_creator 
                LEFT JOIN event_offers_schedule eos ON eos.id = eo.id_event_offers_schedule 
                INNER JOIN activities act ON eo.id_activity = act.id 
                INNER JOIN segments seg ON act.id_segments = seg.id 
                INNER JOIN family fam ON act.id_family = fam.id 
                INNER JOIN status sta ON sta.id = eo.id_status 
                INNER JOIN currency cur ON cur.id = eo.id_currency
                WHERE eo.id = :id"
            );
            $query->execute(["id" => $id]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return null;
            }
            return $data;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function save()
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare("INSERT INTO `event_offers` (`id`, `id_creator`, `id_event_offers_schedule`, `id_status`, `id_activity`, `description`, `id_currency`, `object`, `budget`) 
            VALUES (NULL, :id_creator, :id_event_offers_schedule, :id_status, :id_activity, :description, :id_currency, :object, :budget)");
            $query->execute([
                "id_creator" => $this->idCreator,
                "id_event_offers_schedule" => $this->idSchedule,
                "id_status" => $this->idStatus,
                "id_activity" => $this->idActivity,
                "description" => $this->description,
                "id_currency" => $this->idCurrency,
                "object" => $this->object,
                "budget" => $this->budget
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public static function getDocumentEvent(string|int $id)
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare("SELECT route_doc FROM `event_offers_docs` WHERE id_event_offers = :id");
            $query->execute(["id" => $id]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return null;
            }
            return $data;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public static function saveDocumentEvent(string $id, string $route)
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare("INSERT INTO `event_offers_docs` (`id`, `route_doc`, `id_event_offers`) VALUES (NULL, :route, :id_event);");
            $query->execute([
                "route" => $route,
                "id_event" => $id
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public static function getAllScheduleEvents()
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare("SELECT eo.id, eos.full_start_date, eos.full_end_date,
                (CASE WHEN NOW() >= eos.full_start_date AND NOW() <= eos.full_end_date THEN 2 WHEN NOW() >= eos.full_end_date THEN 3 ELSE '1' END) AS estado
                FROM event_offers eo INNER JOIN users u ON u.id_user = eo.id_creator LEFT JOIN event_offers_schedule eos ON eos.id = eo.id_event_offers_schedule;");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return null;
            }
            return $data;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public static function updateScheduleEvent(int|string $id_status, int|string $id_event){
        try {
            $db = new Database();
            $query = $db->connect()->prepare("UPDATE `event_offers` SET `id_status` = :id_status WHERE `event_offers`.`id` = :id_event");
            $query->execute([
                "id_event" => $id_event,
                "id_status" => $id_status,
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
}
