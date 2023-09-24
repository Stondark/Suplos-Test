<?php

namespace Pipeg\Suplos\utils;

class Password{

    public static function encryptPassword(string $password) : string{
        $options = [
            "cost" => 12
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

}