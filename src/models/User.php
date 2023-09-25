<?php

namespace Pipeg\Suplos\models;
use Pipeg\Suplos\db\Database;
use PDOException;
use Exception;
use PDO;

class User{

    private int $id;
    private string $username;
    private string $password;

    public function __construct(string $username, string $password){
        $this->username = $username;
        $this->password = $password;
    }

    public static function getUser(string $username): User{
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT id_user, username, password FROM users WHERE username = :username");
            $query->execute([
                "username" => $username
            ]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $user = new User($data["username"], $data["password"]);
            $user->setID($data["id_user"]);
            return $user;
        } catch(PDOException $e){
            throw new PDOException($e);
        }
    }

    public function comparePassword(string $password): bool{
        return password_verify($password, $this->password);
    }

    public function getID(){
        return $this->id;
    }

    public function setID($value){
        $this->id = $value;
    }
    
    public static function existUser(string $username) : bool{
        try {
            $db = new Database();
            $query = $db->connect()->prepare("SELECT username FROM users WHERE username = :username");
            $query->execute(["username" => $username]);
            return $query->rowCount() >= 1 ? true : false;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

}