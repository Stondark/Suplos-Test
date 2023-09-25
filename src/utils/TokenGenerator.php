<?php
namespace Pipeg\Suplos\utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenGenerator{
    

    public static function generateToken(string $data) : string{
        $payload = [
            "exp" => strtotime("now") + 3600, // Tiempo de expiración = 1hra 
            "data" => $data
        ];
        $key = $_ENV["SECRET_KEY"];
        return JWT::encode($payload,$key, "HS256");
    }

    public static function validateToken(string $token){
        $key = $_ENV["SECRET_KEY"];
        return JWT::decode($token, new Key($key, "HS256"));
    }
}