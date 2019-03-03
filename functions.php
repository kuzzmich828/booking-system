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

function bkng_save_booking(){
    if (isset($_POST['save_booking'])){

        $fields = [];
        $fields['booking_id'] = (isset($_POST['booking_id']) && $_POST['booking_id']) ? $_POST['booking_id'] : null;
        $fields['fw_option:name'] = (isset($_POST['name_booking']) && $_POST['name_booking']) ? $_POST['name_booking'] : null;
        $fields['fw_option:phone'] = (isset($_POST['phone_booking']) && $_POST['phone_booking']) ? $_POST['phone_booking'] : null;
        $fields['fw_option:email'] = (isset($_POST['email_booking']) && $_POST['email_booking']) ? $_POST['email_booking'] : null;
        $fields['fw_option:discount'] = (isset($_POST['discount_booking']) && $_POST['discount_booking']) ? $_POST['discount_booking'] : null;
        $fields['fw_option:notes'] = (isset($_POST['notes_booking']) && $_POST['notes_booking']) ? $_POST['notes_booking'] : null;
        $fields['fw_option:price'] = (isset($_POST['price_booking']) && $_POST['price_booking']) ? $_POST['price_booking'] : null;

        foreach ($fields as $key => $val){
            update_post_meta($fields['booking_id'], $key, $val);
        }

    }
}