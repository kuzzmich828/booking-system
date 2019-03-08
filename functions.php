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


function get_booking_count_by_date(){

    $query = new WP_Query([
        'post_type' =>  'booking',
        'post_status' => 'publish',
        'meta_key' => 'fw_option:room_date',
        'meta_query' => array(
            'relation' => 'OR',
            [
                'key' => 'fw_option:room_date',
                'compare' => 'LIKE',
                'value' => '-02-2019',
            ],
            [
                'key' => 'fw_option:room_date',
                'compare' => 'LIKE',
                'value' => '-03-2019',
            ],
        ),
    ]);

    $posts = $query->get_posts();
    $response = [];

    foreach ($posts as $post){
        $date = get_post_meta($post->ID, "fw_option:room_date", true);
        if (isset($response[$date])){
            $response[$date]++;
        } else {
            $response[$date] = 1;
        }
    }

    $dates = [];
    foreach ($response as $k => $v){
        $dates[] = [
            'date' => $k,
            'count' => $v
        ];
    }


    return (json_encode($dates));

}


function get_booking_after_date($from_date, $time, $frozen = null, $approve = null){

    $from_date = DateTime::createFromFormat('d-m-Y H:i', $from_date . " " . $time);

    $date = $from_date;
    $date_1 = $date->format('-m-Y');
    $date_2 = $date->modify('+1 month')->format('-m-Y');
    $date_3 = $date->modify('+1 month')->format('-m-Y');

    $args = [
        'post_type' =>  'booking',
        'post_status' => 'publish',
        'meta_key' => 'fw_option:room_date',
        'meta_query' => array(
            'relation' => 'AND',
            [
                'relation' => 'OR',
                [
                    'key' => 'fw_option:room_date',
                    'compare' => 'LIKE',
                    'value' => $date_1,
                ],
                [
                    'key' => 'fw_option:room_date',
                    'compare' => 'LIKE',
                    'value' => $date_2,
                ],
                [
                    'key' => 'fw_option:room_date',
                    'compare' => 'LIKE',
                    'value' => $date_3,
                ],
            ],

        ),
    ];

    if ($frozen){
        $args['meta_query'][] = [
                'key' => 'fw_option:frozen',
                'compare' => '=',
                'value' => $frozen
            ];
    }
    if ($approve){
        $args['meta_query'][] = [
            'key' => 'fw_option:approve',
            'compare' => '=',
            'value' => $approve
        ];
    }
    $query = new WP_Query($args);

    $posts = $query->get_posts();
    $response = [];

    foreach ($posts as $booking){
        $date = get_post_meta($booking->ID, "fw_option:room_date", true);
        $time = get_post_meta($booking->ID, "fw_option:room_time", true);

        $timestamp = DateTime::createFromFormat('d-m-Y H:i', $date . " " . $time)->getTimestamp();

        if ($timestamp > time()){
            $meta = get_all_meta_booking($booking->ID);
            $response[] = array_merge(['timestamp' => $timestamp], $meta);
        }
    }

    usort($response, 'sort_by_timestamp');

    return $response;

}

function sort_by_timestamp($a, $b){
    if ($a['timestamp'] == $b['timestamp']) {
        return 0;
    }
    return ($a['timestamp'] < $b['timestamp']) ? -1 : 1;
}

function get_all_meta_booking($id){

    $room_id = get_post_meta($id, 'fw_option:room', 1);
    $room_name = get_the_title($room_id);

    return [
        'booking_id'    => $id,
        'email' => get_post_meta($id, 'fw_option:email', 1),
        'name'    => get_post_meta($id, 'fw_option:name', 1),
        'phone'    => get_post_meta($id, 'fw_option:phone', 1),
        'comments'    => get_post_meta($id, 'fw_option:comments', 1),
        'amount_price'    => get_post_meta($id, 'fw_option:amount_price', 1),
        'discount'    => get_post_meta($id, 'fw_option:discount', 1),

        'approve'    => get_post_meta($id, 'fw_option:approve', 1),
        'frozen'    => get_post_meta($id, 'fw_option:frozen', 1),
        'room_date'    => get_post_meta($id, 'fw_option:room_date', 1),
        'room_time'    => get_post_meta($id, 'fw_option:room_time', 1),
        'room_id' => $room_id,
        'room_name' => $room_name,
    ];

}
