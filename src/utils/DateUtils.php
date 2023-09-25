<?php
namespace Pipeg\Suplos\utils;



class DateUtils{

    public static function generateDatetime($start_date, $start_time){
        $all_param = func_get_args();
        foreach ($all_param as $value) {
            if(!strtotime($value)){
                throw new ("Los formatos de hora y fecha están mal formados");
            }
        }

        $timestamp = strtotime($start_date . " " . $start_time);
        return date('Y-m-d H:i:s', $timestamp);
    }



}