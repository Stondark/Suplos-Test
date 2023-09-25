<?php

namespace Pipeg\Suplos\models;
use Pipeg\Suplos\db\Database;
use PDO;
use PDOException;

class Family{

    public static function getAllFamily(){
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT f.*, s.description_segment FROM family f INNER JOIN segments s ON f.id_segment = s.id");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            throw new PDOException($e);
        }
    }
    public static function getByIdFamily(int $id){
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT f.*, s.description_segment FROM family f INNER JOIN segments s ON f.id_segment = s.id WHERE f.id = :id");
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

    public static function getByIdSegmentFamily(int $id){
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT f.*, s.description_segment FROM family f INNER JOIN segments s ON f.id_segment = s.id WHERE f.id_segment = :id");
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