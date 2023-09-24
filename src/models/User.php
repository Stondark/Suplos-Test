<?php

namespace Pipeg\Suplos\models;
use Pipeg\Suplos\db\Database;
use PDOException;
use Exception;
use PDO;

class User{

    private string $username;
    private string $password;

    public function __construct(string $username, string $password){
        $this->username = $username;
        $this->password = $password;
    }

    public static function getUser(string $username): User{
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT username, password FROM users WHERE username = :username");
            $query->execute([
                "username" => $username
            ]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            return new User($data["username"], $data["password"]);
        } catch(PDOException $e){
            throw new PDOException($e);
        }
    }

    public function comparePassword(string $password): bool{
        error_log($password . $this->password);
        return password_verify($password, $this->password);
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