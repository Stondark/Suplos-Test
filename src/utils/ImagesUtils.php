<?php

namespace Pipeg\Suplos\utils;

class ImagesUtils
{

    public static function storeFile(array $file): string|bool
    {

        $target_dir = "src/public/";
        // var_dump($file);
        $extarr = explode(".", $file["name"]);
        $filename = $extarr[count($extarr) - 2];
        $ext = $extarr[count($extarr) - 1];
        $hash = md5(date("Ymdgi") . $filename) . "." . $ext;
        $target_file = $target_dir . $hash;
        $check = getimagesize($file["tmp_name"]);
        $check !== false ? $uploadOk = 1 : $uploadOk = 0;
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}
