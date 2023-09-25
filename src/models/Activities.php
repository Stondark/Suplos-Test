<?php

namespace Pipeg\Suplos\models;
use Pipeg\Suplos\db\Database;
use PDO;
use PDOException;

class Activities{

    public static function saveActivities($idSeg, $idFam){
        try{
            $db = new Database();
            $pdo = $db->connect();
            $query = $pdo->prepare("INSERT INTO `activities` (`id`, `id_segments`, `id_family`) VALUES (NULL, :id_segments, :id_family)");
            $query->execute(["id_segments" => $idSeg, "id_family" => $idFam]);
            return $pdo->lastInsertId();
        } catch(PDOException $e){
            throw new PDOException($e);
        }
    }

    public static function getIdActivities($idSeg, $idFam) : null|int{
        try{
            $db = new Database();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT id FROM `activities` WHERE `id_segments` = :id_segments AND id_family = :id_family;");
            $query->execute(["id_segments" => $idSeg, "id_family" => $idFam]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if(empty($data)){
                return null;
            }
            return $data["id"];
        } catch(PDOException $e){
            throw new PDOException($e);
        }
    }

    public static function validActivities($idSeg, $idFam) : null|int{
        try{
            $db = new Database();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT id FROM `family` WHERE id_segment = :id_segments AND id = :id_family");
            $query->execute(["id_segments" => $idSeg, "id_family" => $idFam]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if(empty($data)){
                return null;
            }
            return $data["id"];
        } catch(PDOException $e){
            throw new PDOException($e);
        }
    }



}