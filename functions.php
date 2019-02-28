<?php

function get_times_format(){
    $times = [];
    for ($i = 0; $i < 24; $i++){

        if ($i < 10){
            $hours = "0$i";
        } else
            $hours = $i;

        $times [] = "$hours:00";
        $times [] = "$hours:15";
        $times [] = "$hours:30";
        $times [] = "$hours:45";
    }

    return $times;
}