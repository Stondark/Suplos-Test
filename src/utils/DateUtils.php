<?php
namespace Pipeg\Suplos\utils;



class DateUtils{

    // Validamos que los argumentos pasados estén en un formato de fecha correcto y retornamos una excepción
    public static function generateDatetime($start_date, $start_time){
        $all_param = func_get_args();
        foreach ($all_param as $value) {
            if(!strtotime($value)){
                throw new ("The time and date formats are malformed.");
            }
        }

        $timestamp = strtotime($start_date . " " . $start_time);
        // Retornamos los valores en este formato para que puedan ser guardados en la base de datos
        return date('Y-m-d H:i:s', $timestamp);
    }



}