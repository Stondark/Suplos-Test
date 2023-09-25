<?php

namespace Pipeg\Suplos\models;
use Pipeg\Suplos\db\Database;
use PDO;
use PDOException;

class Segments{

    public static function getAllSegments(){
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT * FROM segments");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            throw new PDOException($e);
        }
    }

    

    public static function getByIdSegments(int $id){
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT * FROM segments WHERE id = :id");
            $query->execute(["id" => $id]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if(empty($data)){
                return null;
            }

            return $data;
        } catch(PDOException $e){
            throw new PDOException($e);
        }
    }
    

}