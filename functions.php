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

        if (!$_POST['price_booking']){
            return false;
        }

        $booking_id = '';
        $fields['booking_id'] = (isset($_POST['booking_id']) && $_POST['booking_id']) ? $_POST['booking_id'] : null;
        $fields['fw_option:room'] = (isset($_POST['room_id']) && $_POST['room_id']) ? $_POST['room_id'] : null;
        $fields['fw_option:name'] = (isset($_POST['name_booking']) && $_POST['name_booking']) ? $_POST['name_booking'] : null;
        $fields['fw_option:phone'] = (isset($_POST['phone_booking']) && $_POST['phone_booking']) ? $_POST['phone_booking'] : null;
        $fields['fw_option:email'] = (isset($_POST['email_booking']) && $_POST['email_booking']) ? $_POST['email_booking'] : null;
        $fields['fw_option:discount'] = (isset($_POST['discount_booking'])) ? (int)$_POST['discount_booking'] : null;
        $fields['fw_option:comments'] = (isset($_POST['notes_booking']) && $_POST['notes_booking']) ? $_POST['notes_booking'] : null;
        $fields['fw_option:amount_price'] = (isset($_POST['price_booking'])) ? (float)$_POST['price_booking'] : null;
        $fields['fw_option:approve'] = 'off';
        $fields['fw_option:frozen'] = 'off';
        $fields['fw_option:canceled'] = 'off';
        $fields['fw_option:quantity'] = (isset($_POST['price_booking'])) ? (float)$_POST['price_booking'] : null;

        $fields['fw_option:room_date'] = (isset($_POST['room_date']) && $_POST['room_date']) ? DateTime::createFromFormat('d-m-Y', $_POST['room_date'])->format('d-m-Y') : null;
        $fields['fw_option:room_time'] = (isset($_POST['room_time']) && $_POST['room_time']) ? $_POST['room_time'] : null;

        $fields['fw_option:subscription'] = 'on'; //(isset($_POST['subscription']) && ($_POST['subscription']) == 'true') ? 'on' : 'off';
        $fields['fw_option:approve_person'] = '';
        $fields['fw_option:approve_time'] = '';
        $fields['fw_option:amount'] = (isset($_POST['price']) && $_POST['price']) ? $_POST['price'] : null;

        if (isset($_POST['frozen_booking'])) {
            $fields['fw_option:frozen'] = ($_POST['frozen_booking'] == 'on') ? 'on' : 'off';
        } else {
            $fields['fw_option:frozen'] = 'off';
        }

        if (isset($_POST['canceled_booking'])) {
            if ($fields['fw_option:canceled'] == 'off' && $_POST['canceled_booking'] == 'on'){
                $wpcf_time = get_post_meta($fields['fw_option:room'], 'wpcf-time', 1);
                $room_name = get_the_title($fields['fw_option:room']);
                bkng_write_log("Cancelled booking #".$fields['booking_id']." | Attr:".json_encode($fields));
                send_email('delete', $fields['fw_option:email'], get_all_meta_booking($fields['booking_id']), false);

            }
            $fields['fw_option:canceled'] = ($_POST['canceled_booking'] == 'on') ? 'on' : 'off';

        } else {
            $fields['fw_option:canceled'] = 'off';
        }

        if (isset($_POST['approve_booking'])) {
            $fields['fw_option:approve'] = ($_POST['approve_booking'] == 'on') ? 'on' : 'off';
            approveBookingData($fields['booking_id']);
        } else {
            $fields['fw_option:approve'] = 'off';
            approveBookingData($fields['booking_id'], true);
        }
        /***************** ********************/

        if ($fields['booking_id'] != null) {

            if ($fields['fw_option:approve'] == 'on') {
                approveBookingData($fields['booking_id']);
            } else {
                approveBookingData($fields['booking_id'], true);
            }

            foreach ($fields as $key => $val) {
                if ($key == 'fw_option:approve'){
                    do_action('approve_booking_hook', $fields['booking_id'], $fields['fw_option:approve']);
                } elseif ($val !== null ) {
                    update_post_meta($fields['booking_id'], $key, $val);
                }
            }

            $booking_id = $_POST['booking_id'];

            updateRoomQuantity($booking_id, $fields['fw_option:room'], $fields['fw_option:amount_price']);
            callback_post_options_update($booking_id);
            bkng_write_log("User #".get_current_user_id()." UPDATE booking #".$booking_id." | Attr:".json_encode($fields));
        }elseif($fields['fw_option:room'] != null){

            if (check_room_for_booking($fields['fw_option:room'], $fields['fw_option:room_date'], $fields['fw_option:room_time']))
                return false;
            $response = create_booking($fields);
            $booking_id = $response['booking_id'];

            $response = get_all_meta_booking($booking_id);
            send_email('new', $response['email'], get_all_meta_booking($booking_id), false);


            if ($fields['fw_option:approve'] == 'on') {
                approveBookingData($booking_id);
                send_email('confirm', $response['email'], get_all_meta_booking($booking_id), false);
            }

        }

        return $booking_id;
    }
    return false;
}

function get_booking_count_by_date(){


    if (date("m") == '01'){
        $date_1 = date("m", strtotime("-1 month", current_time('timestamp'))).date('-Y');
        $date_2 = date('01-Y');
        $date_3 = date("02-Y");
        $date_4 = date("03-Y");
        $date_5 = date("04-Y");
    } elseif (date("m") == '02') {
        $date_1 = date('01-Y');
        $date_2 = date('02-Y');
        $date_3 = date("03-Y");
        $date_4 = date("04-Y");
        $date_5 = date("05-Y");
    }else{
        $date_1 = date("m", strtotime("-1 month", current_time('timestamp'))) . date('-Y');
        $date_2 = date('m-Y');
        $date_3 = date("m-Y", strtotime("+1 month", current_time('timestamp')));
        $date_4 = date("m-Y", strtotime("+2 month", current_time('timestamp')));
        $date_5 = date("m-Y", strtotime("+3 month", current_time('timestamp')));
    }

    $query = new WP_Query([
        'posts_per_page' => -1,
        'post_type' =>  'bookings',
        'post_status' => 'publish',
        'meta_key' => 'fw_option:room_date',
        'meta_query' => array(
            'relation' => 'OR',
            [
                'key' => 'fw_option:room_date',
                'compare' => 'LIKE',
                'value' => '-'.$date_1,
            ],
            [
                'key' => 'fw_option:room_date',
                'compare' => 'LIKE',
                'value' => '-'.$date_2,
            ],
            [
                'key' => 'fw_option:room_date',
                'compare' => 'LIKE',
                'value' => '-'.$date_3,
            ],
            [
                'key' => 'fw_option:room_date',
                'compare' => 'LIKE',
                'value' => '-'.$date_4,
            ],
            [
                'key' => 'fw_option:room_date',
                'compare' => 'LIKE',
                'value' => '-'.$date_5,
            ],
        ),
    ]);

    $posts = $query->posts;
    $response = [];

    foreach ($posts as $post){
        $date = get_post_meta($post->ID, "fw_option:room_date", true);
        $frozen = get_post_meta($post->ID, "fw_option:frozen", true);
        $canceled = get_post_meta($post->ID, "fw_option:canceled", true);

        if ($frozen == 'on' || $canceled == 'on')
            continue;

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

    if (date("m") == '01' && date("d") > 27) {
        $date_2 = $date->modify('+27 day')->format('-m-Y');
        $date_3 = $date->modify('+1 month')->format('-m-Y');
    }else{
        $date_2 = $date->modify('+1 month')->format('-m-Y');
        $date_3 = $date->modify('+1 month')->format('-m-Y');
    }

    $args = [
        'posts_per_page' =>  -1,
        'post_type' =>  'bookings',
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
//                [
//                    'key' => 'fw_option:room_date',
//                    'compare' => 'LIKE',
//                    'value' => $date_3,
//                ],
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
    $posts = $query->posts;

    $response = [];

    foreach ($posts as $booking){

        $date = get_post_meta($booking->ID, "fw_option:room_date", true);
        $time = get_post_meta($booking->ID, "fw_option:room_time", true);
        $canceled = get_post_meta($booking->ID, "fw_option:canceled", true);

        if (!$date || !$time || $canceled == 'on'){
            continue;
        }

        $timestamp = false;
        $timeformat = DateTime::createFromFormat('d-m-Y H:i', "$date $time");
        if ($timeformat)
            $timestamp = $timeformat->getTimestamp();


        if ($timestamp)
            if ($timestamp > current_time('timestamp')){
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
        'amount'    => get_post_meta($id, 'amount', 1),
        'discount'    => get_post_meta($id, 'fw_option:discount', 1),

        'approve_time'    => get_post_meta($id, 'fw_option:approve_time', 1),
        'approve_person'    => get_post_meta($id, 'fw_option:approve_person', 1),
        'approve'    => get_post_meta($id, 'fw_option:approve', 1),
        'frozen'    => get_post_meta($id, 'fw_option:frozen', 1),
        'canceled'    => get_post_meta($id, 'fw_option:canceled', 1),
        'room_date'    => get_post_meta($id, 'fw_option:room_date', 1),
        'room_time'    => get_post_meta($id, 'fw_option:room_time', 1),
        'quantity'    => get_post_meta($id, 'fw_option:quantity', 1),
        'room_id' => $room_id,
        'room_name' => $room_name,
        'wpcf_time' => get_post_meta($room_id, 'wpcf-time', 1),
        'email_template' => get_post_meta($room_id, 'fw_option:email_template', 1)
    ];

}

function bkng_get_booking_rooms(){

    remove_action('pre_get_posts','add_post_format_filter_to_posts');
    global $wpdb;
    $rooms = $wpdb->get_results("SELECT * FROM {$wpdb->posts} WHERE `post_type` = 'room' AND `post_status` = 'publish';");
    add_action('pre_get_posts','add_post_format_filter_to_posts');
    return $rooms;
}

function delTree($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

function rcopy($src, $dest){

    // If source is not a directory stop processing
    if(!is_dir($src)) return false;

    // If the destination directory does not exist create it
    if(!is_dir($dest)) {
        if(!mkdir($dest)) {
            // If the destination directory could not be created stop processing
            return false;
        }
    }

    // Open the source directory to read in files
    $i = new DirectoryIterator($src);
    foreach($i as $f) {
        if($f->isFile()) {
            copy($f->getRealPath(), "$dest/" . $f->getFilename());
        } else if(!$f->isDot() && $f->isDir()) {
            rcopy($f->getRealPath(), "$dest/$f");
        }
    }
}

add_action('admin_footer', function (){
    ?><script type="application/javascript">
        jQuery(document).click('.hndle.ui-sortable-handle',function () {
            jQuery(this).find(".postbox.fw-postbox.initialized").removeClass("closed");
        });
    </script><?php
});

add_action('admin_footer', function (){
    ?>
    <style>
        #menu-posts-booking_, #menu-posts-bookings ul, #fw-backend-option-fw-option-approve_time, #fw-backend-option-fw-option-approve_person {
            display: none;
        }
    </style>
    <?php
});

add_action('wp_footer', function (){

    $posts = get_posts([
        'post_type'=>'room',
        'numberposts'=> -1,
        'post_status'=> 'publish'
    ]);
    $rooms = [];
    foreach ($posts as $post){
        $rooms[] = $post->ID."|||".$post->post_title;
    }

    ?>
    <script>
        var rooms_JSON = <?= json_encode($rooms); ?>;

        function findRoomByID(url_room_id){
            var name  = false;
            jQuery(rooms_JSON).each(function(key, data) {
                var one = data.split('|||');
                if (one[0] === url_room_id){
                    name = one[1];
                    return;
                }
            });
            return name;
        }

        function findRoomByName(room_name){
            var id = false;
            jQuery(rooms_JSON).each(function(key, data) {
                var one = data.split('|||');
                if (one[1] == room_name){
                    id = one[0];
                    return;
                }
            });
            return id;
        }


        jQuery(window).load(function(){
            if (window.location.href.indexOf("room_id=") > 0){
                var url = new URL(document.location.href);
                var query_string = url.search;
                var search_params = new URLSearchParams(query_string);
                var url_room_id = search_params.get('room_id');

                var room_name = findRoomByID(url_room_id);
                console.log("room_name",room_name);
                jQuery('a[data-room-name="'+room_name+'"]').click();
            }
        });
    </script>
    <?php
});

function check_room_for_booking($room_id, $date, $time){
    $query = new WP_Query([
        'posts_per_page' => -1,
        'post_type' =>  'bookings',
        'post_status' => 'publish',
        'meta_key' => 'fw_option:room_date',
        'meta_query' => array(
            'relation' => 'AND',
            [
                'key' => 'fw_option:room_date',
                'value' => $date,
            ],
            [
                'key' => 'fw_option:room_time',
                'value' => $time,
            ],
            [
                'key' => 'fw_option:room',
                'value' => $room_id,
            ],
            [
                'key' => 'fw_option:canceled',
                'compare' => 'NOT LIKE',
                'value' => 'on',
            ],
        ),
    ]);
    return $query->post_count;
}

function bkng_write_log($str){
    $f = fopen(WP_CONTENT_DIR."/log_booking.txt", 'a');
    fwrite($f, date('d.m.Y H:i:s', current_time('timestamp'))." {$str}\n");
    fclose($f);
    return;
}

function check_capability_delete_button(){
    $users = fw_get_db_settings_option('user_can_delete');
    if (in_array(get_current_user_id(), $users))
        return true;

    return false;
}

function check_capability_other_button(){
    if (in_array('out-side', wp_get_current_user()->roles))
        return true;

    return false;
}
