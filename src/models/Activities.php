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

}