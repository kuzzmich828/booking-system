<?php

add_action('init', 'bkng_register_posts_type');
function bkng_register_posts_type(){
    register_post_type('room', array(
        'labels'             => array(
            'name'               => __('Rooms', 'booking-system'),
            'singular_name'      => __('Room', 'booking-system'),
            'add_new'            => __('Add new', 'booking-system'),
            'add_new_item'       => __('Add new', 'booking-system'),
            'edit_item'          => __('Edit', 'booking-system'),
            'new_item'           => __('New room', 'booking-system'),
            'view_item'          => __('View', 'booking-system'),
            'search_items'       => __('Find', 'booking-system'),
            'not_found'          =>  __('Not found', 'booking-system'),
            'not_found_in_trash' => __('Not found', 'booking-system'),
            'parent_item_colon'  => '',
            'menu_name'          => __('Rooms', 'booking-system')

        ),
        'capabilities' => array(
            'edit_post'          => 'edit_room',
            'read_post'          => 'read_room',
            'delete_private_posts'        => 'delete_private_room',
            'delete_published_posts'        => 'delete_published_room',
            'delete_posts'        => 'delete_room',
            'delete_others_posts' => 'delete_others_room',
            'edit_posts'         => 'edit_room',
            'edit_others_posts'  => 'edit_others_room',
            'publish_posts'      => 'publish_room',
            'create_posts'       => 'edit_room',
            'read_private_posts' => 'read_private_room',

        ),

        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => false,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'room',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => false,
        'menu_icon'          => 'dashicons-grid-view',
        'supports'           => array('title','author','thumbnail', 'editor', 'revisions')
    ) );

    register_post_type('room-emails', array(
        'labels'             => array(
            'name'               => __('Emails', 'booking-system'),
            'singular_name'      => __('Email', 'booking-system'),
            'add_new'            => __('Add new', 'booking-system'),
            'add_new_item'       => __('Add new', 'booking-system'),
            'edit_item'          => __('Edit', 'booking-system'),
            'new_item'           => __('New Email', 'booking-system'),
            'view_item'          => __('View', 'booking-system'),
            'search_items'       => __('Find', 'booking-system'),
            'not_found'          =>  __('Not found', 'booking-system'),
            'not_found_in_trash' => __('Not found', 'booking-system'),
            'parent_item_colon'  => '',
            'menu_name'          => __('Emails', 'booking-system')

        ),
        'capabilities' => array(
            'edit_post'          => 'edit_room',
            'read_post'          => 'read_room',
            'delete_private_posts'        => 'delete_private_room',
            'delete_published_posts'        => 'delete_published_room',
            'delete_posts'        => 'delete_room',
            'delete_others_posts' => 'delete_others_room',
            'edit_posts'         => 'edit_room',
            'edit_others_posts'  => 'edit_others_room',
            'publish_posts'      => 'publish_room',
            'create_posts'       => 'edit_room',
            'read_private_posts' => 'read_private_room',

        ),

        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => false,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'room',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'menu_icon'          => 'dashicons-email',
        'supports'           => array('title','author', 'revisions')
    ) );

    register_post_type('bookings', array(
        'labels'             => array(
            'name'               => __('Booking', 'booking-system'),
            'singular_name'      => __('Booking', 'booking-system'),
            'add_new'            => __('Add new', 'booking-system'),
            'add_new_item'       => __('Add new', 'booking-system'),
            'edit_item'          => __('Edit', 'booking-system'),
            'new_item'           => __('New', 'booking-system'),
            'view_item'          => __('View', 'booking-system'),
            'search_items'       => __('Find', 'booking-system'),
            'not_found'          =>  __('Not found', 'booking-system'),
            'not_found_in_trash' => __('Not found', 'booking-system'),
            'parent_item_colon'  => '',
            'menu_name'          => __('Booking', 'booking-system')

        ),
        'capabilities' => array(
            'edit_post'          => 'edit_booking',
            'read_post'          => 'read_booking',
            'delete_post'        => 'delete_booking',
            'edit_posts'         => 'edit_booking',
            'edit_others_posts'  => 'edit_others_booking',
            'publish_posts'      => 'publish_booking',
            'read_private_posts' => 'read_private_booking',
            'create_posts'       => 'edit_booking',
            'delete_private_posts'        => 'delete_private_booking',
            'delete_published_posts'        => 'delete_published_booking',
            'delete_posts'        => 'delete_booking',
            'delete_others_posts' => 'delete_others_booking',
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => false,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'booking',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 4,
        'menu_icon'          => 'dashicons-feedback',
        'supports'           => array('title','author', 'revisions')
    ) );

    register_post_type('roomcontent', array(
        'labels'             => array(
            'name'               => __('Room content', 'booking-system'),
            'singular_name'      => __('Room content', 'booking-system'),
            'add_new'            => __('Add new', 'booking-system'),
            'add_new_item'       => __('Add new', 'booking-system'),
            'edit_item'          => __('Edit', 'booking-system'),
            'new_item'           => __('New Room Content', 'booking-system'),
            'view_item'          => __('View', 'booking-system'),
            'search_items'       => __('Find', 'booking-system'),
            'not_found'          =>  __('Not found', 'booking-system'),
            'not_found_in_trash' => __('Not found', 'booking-system'),
            'parent_item_colon'  => '',
            'menu_name'          => __('Room content', 'booking-system')

        ),
        'capabilities' => array(
            'edit_post'          => 'edit_room',
            'read_post'          => 'read_room',
            'delete_private_posts'        => 'delete_private_room',
            'delete_published_posts'        => 'delete_published_room',
            'delete_posts'        => 'delete_room',
            'delete_others_posts' => 'delete_others_room',
            'edit_posts'         => 'edit_room',
            'edit_others_posts'  => 'edit_others_room',
            'publish_posts'      => 'publish_room',
            'create_posts'       => 'edit_room',
            'read_private_posts' => 'read_private_room',

        ),

        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => false,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'room',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'menu_icon'          => 'dashicons-grid-view',
        'supports'           => array('title','author','thumbnail', 'editor', 'revisions')
    ) );

}

add_action( 'wp_ajax_get_booking_rooms', 'callback_get_booking_rooms' );
add_action( 'wp_ajax_nopriv_get_booking_rooms', 'callback_get_booking_rooms' );
function callback_get_booking_rooms(){

    $rooms = get_posts([
        'post_type'=>'bookings',
        'post_status'=>'publish',
        'posts_per_page'=>-1,
    ]);

    wp_send_json(json_encode($rooms), 200);
}

add_action( 'wp_ajax_get_room_times', 'callback_get_room_times' );
add_action( 'wp_ajax_nopriv_get_room_times', 'callback_get_room_times' );
function callback_get_room_times(){
    $times = get_post_meta($_POST['id'], 'fw_option:times', 1);
    wp_send_json(json_encode($times), 200);
}

add_action( 'wp_ajax_get_booking_room_date', 'callback_get_booking_room_date' );
add_action( 'wp_ajax_nopriv_get_booking_room_date', 'callback_get_booking_room_date' );
function callback_get_booking_room_date(){

    if (stristr($_POST['date'], "-") === false){
        $date = date("d-m-Y", $_POST['date']);
    }else{
        $date = DateTime::createFromFormat("d-m-Y", $_POST['date'])->format("d-m-Y");
    }

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
                'key' => 'fw_option:room',
                'value' => $_POST['room_id'],
            ],
        ),
    ]);

    $posts = $query->posts;
    $times = [];

    foreach ($posts as $post){
        $is_canceled = get_post_meta($post->ID, 'fw_option:canceled', true);

        if ($is_canceled == 'on')
            continue;
        
        $times [] = get_post_meta($post->ID, "fw_option:room_time", true);
    }

    wp_send_json(json_encode($times), 200);
}


add_action( 'wp_ajax_get_room_attributes', 'callback_get_room_attributes' );
add_action( 'wp_ajax_nopriv_get_room_attributes', 'callback_get_room_attributes' );
function callback_get_room_attributes(){

    $room_id = false;
    if (!isset($_POST['id']) || !$_POST['id'] || $_POST['id'] == '' || $_POST['id'] == 'false'){
        if (isset($_POST['room_name'])){
            $room_name =  ($_POST['room_name']);
            global $wpdb;
            $room_id = $wpdb->get_var( "SELECT ID FROM {$wpdb->posts} WHERE post_title = '{$room_name}' AND post_type = 'room'" );
        }
    } else {
        $room_id = $_POST['id'];
    }

    if (!$room_id)
        wp_send_json(json_encode([]), 200);

    global $wpdb;

    $the_last_date = $wpdb->get_var( "SELECT {$wpdb->posts}.post_date FROM {$wpdb->posts} LEFT JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id 
                                        WHERE {$wpdb->posts}.post_type = 'bookings' AND {$wpdb->posts}.post_status = 'publish' AND
                                         {$wpdb->postmeta}.meta_key = 'fw_option:room' AND {$wpdb->postmeta}.meta_value = '{$room_id}' ORDER BY {$wpdb->posts}.post_date DESC;" );


    $the_last_date = (!$the_last_date) ? (date('d.m.Y H:i:s', current_time('timestamp') - 500)) : $the_last_date;
    $current_date = current_time('d.m.Y H:i:s');
    $seconds = floor((strtotime($current_date) - strtotime($the_last_date)));
    $minutes = floor($seconds / 60);      // Считаем минуты
    $hours = floor($minutes / 60);        // Считаем количество полных часов
    $seconds =  ((int)$seconds - (int)($minutes * 60));      // Считаем количество оставшихся секунд
    $minutes = abs((int)$minutes - (int)($hours * 60));        // Считаем количество оставшихся минут



    $times = get_post_meta($room_id, 'fw_option:times', 1);
    $pq = get_post_meta($room_id, 'fw_option:prices', 1);
    $the_post = get_post($room_id);
    $data = [];
    $data ['last_order'] = str_replace("-","","$hours:$minutes:$seconds");
    $data ['room_id'] = $room_id;
    $data ['times'] = $times;
    $data ['prices'] = $pq;

    $data ['roomcontent'] = (integer) get_post_meta($room_id, 'fw_option-room-content', 1);
    if ($data['roomcontent']){
        $elementor = new \Elementor\Frontend();
        $data ['description'] = ' ';
        $data ['description'] .= apply_filters('the_content', $elementor->get_builder_content_for_display($data['roomcontent']));
        $data ['description'] .= ' ';
    }else {
        $data ['description'] = apply_filters('the_content', $the_post->post_content);
    }
    $data ['room_name'] = apply_filters('the_title', $the_post->post_title);
    $data ['room_image'] = isset(get_post_meta($room_id, 'fw_option:room_bg_image', 1)['url']) ? get_post_meta($room_id, 'fw_option:room_bg_image', 1)['url'] : '';

    /********* Get room attributes ***********/
    $data ['time_text'] = get_post_meta($room_id, 'wpcf-time', 1);
    $data ['time_icon'] = get_post_meta($room_id, 'wpcf-order-time-icon', 1);

    $data ['people_text'] = get_post_meta($room_id, 'wpcf-people', 1);
    $data ['people_icon'] = get_post_meta($room_id, 'wpcf-people-icon', 1);

    $data ['age_text'] = get_post_meta($room_id, 'wpcf-age', 1);
    $data ['age_icon'] = get_post_meta($room_id, 'wpcf-order-age-icon', 1);

    $data ['complexity_text'] = get_post_meta($room_id, 'wpcf-complexity', 1);
    $data ['complexity_icon'] = get_post_meta($room_id, 'wpcf-order-complexity-icon', 1);
    $data ['percent'] = get_post_meta($room_id, 'wpcf-percent-without-help', 1);
    $data ['icon_text_color'] = get_post_meta($room_id, 'wpcf-icon-text-color', 1);
    $data ['title_color'] = get_post_meta($room_id, 'fw_option:title_color', 1);
    $data ['modal_corner_color'] = get_post_meta($room_id, 'fw_option:modal_corner_color', 1);

    wp_send_json(json_encode($data), 200);
}

add_action( 'wp_ajax_get_booking_rooms_by_date', 'callback_get_booking_rooms_by_date' );
add_action( 'wp_ajax_nopriv_get_booking_rooms_by_date', 'callback_get_booking_rooms_by_date' );
function callback_get_booking_rooms_by_date(){

    $response = [];

    if ($_POST['date']) {

        $date = DateTime::createFromFormat('d-m-Y', $_POST['date']);

        $bookings = get_posts([
            'post_type' => 'bookings',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_key' => 'fw_option:room_date',
            'meta_query' => array(
                'relation' => 'AND',
                [
                    'key' => 'fw_option:room_date',
                    'value' => $date->format("d-m-Y"),
                ],
//                [
//                    'key' => 'fw_option:canceled',
//                    'value' => 'off',
//                ],
            ),
        ]);

        $bookings_all = [];

        $room_for_exclude = [];
        foreach ($bookings as $booking){
            $room_id = get_post_meta($booking->ID, 'fw_option:room', 1);
            $is_canceled = get_post_meta($booking->ID, 'fw_option:canceled', 1);

            if ($is_canceled == 'on')
                continue;

            $room_for_exclude [] = $room_id;
            $bookings_all [] = [
                'id'    => $booking->ID,
                'room_id'    => $room_id,
                'room_time' => get_post_meta($booking->ID, 'fw_option:room_time', 1),
                'room_name'    => get_the_title(get_post_meta($booking->ID, 'fw_option:room', 1)),
                'room_times'    => get_post_meta($room_id, 'fw_option:times', 1),
                'booking_frozen' => get_post_meta($booking->ID, 'fw_option:frozen', 1),
            ];
        }

        $rooms = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'room',
            'post_status' => 'publish',
//            'exclude' => $room_for_exclude,
        ]);

        foreach ($rooms as $room){
            $find_room_booking = false;

            foreach ($bookings_all as $booking_room){
                if ((int)$booking_room['room_id'] == (int)$room->ID){

                    $response [] = $booking_room;
                    $find_room_booking = true;
                }
            }

            if (!$find_room_booking) {
                $response [] = [
                    'id' => null,
                    'room_id' => $room->ID,
                    'room_time' => null,
                    'room_name' => get_the_title($room->ID),
                    'room_times' => get_post_meta($room->ID, 'fw_option:times', 1),
                ];
            }
        }

    }

    wp_send_json(json_encode($response), 200);
}

add_action( 'wp_ajax_get_booking', 'callback_get_booking' );
add_action( 'wp_ajax_nopriv_get_booking', 'callback_get_booking' );
function callback_get_booking(){

    $bookings = get_posts([
        'posts_per_page'=>-1,
        'post_type'=>'bookings',
        'post__in' => [$_POST['booking_id']]
    ]);

    $response = '';
    if (count($bookings) > 0 && $bookings[0]->ID){
        $id = $bookings[0]->ID;
        $response  = get_all_meta_booking($id);
    }

    wp_send_json(json_encode($response), 200);

}

add_action('approve_booking_hook', function ($booking_id, $approve){

    if (!$booking_id || !$approve)
        return;

    $old_val = get_post_meta($booking_id, 'fw_option:approve', true);
    if ($old_val == $approve) {
        return;
    }

    update_post_meta($booking_id, 'fw_option:approve', $approve);

    $response = get_all_meta_booking($booking_id);

    if ($old_val == 'off' && $approve == 'on') {
        send_email('confirm', $response['email'], get_all_meta_booking($booking_id), false);
    }

    approveBookingData($booking_id);
    bkng_write_log("User #".get_current_user_id()." APPROVE booking #{$booking_id}| Attr:".json_encode($response));
}, 10, 2);

add_action('delete_booking_hook', function ($booking_id){
    if (!$booking_id)
        return;
    $user_id = get_current_user_id();
    $attr = get_all_meta_booking($booking_id);
    bkng_write_log("User #{$user_id} DELETE booking #{$booking_id}| Attr:".json_encode($attr));
    wp_delete_post($booking_id);
});

add_action('admin_footer', function (){
    ?>
    <style>
        .wp-core-ui .button-delete{
            padding: 5px 25px;
            font-size: 18px;
            height: auto;
            border-color: black;
            background: #d61111c4;
            color: #fff;
            box-shadow: 0 1px 0 #ff3636;
            margin: 0 10px;
        }
        .wp-core-ui .button-approve{background: #f7ff20b5; color: #4a4a4a; border-color: #4a4a4a; box-shadow: 0 1px 0 #0a7b00b5;}
    </style>
    <?php if (get_locale() == 'he_IL' && isset($_GET['page']) && $_GET['page'] == 'booking-calendar'): ?>
        <style>
            .col-sm-4, .col-sm-3, .col-sm-6, .col-sm-8{float: right;}
            @media screen and (max-width: 782px){
                .col-sm-4, .col-sm-3, .col-sm-6, .col-sm-8{float: none;}
                #wpbody{width: 100%;}
            }

            .fc-calendar .fc-row > div, .fc-calendar .fc-head > div, .fc-calendar .fc-row > div {
                float: left;
            }
            body {
                min-width: auto !important;
            }
        </style>
    <?php endif;

    if (!check_capability_delete_button()): ?>
        <style>.trash{display: none;}</style>
    <?php
    endif;
    if (check_capability_other_button()): ?>
        <style>.btn-success, .edit-button, .change-date-button {display: none !important;}</style>
    <?php
    endif;

});

function approveBookingData($booking_id, $unapprove = false){

    if ($unapprove){
        update_post_meta($booking_id, "fw_option:approve_time", '');
        update_post_meta($booking_id, "fw_option:approve_person", '');
    }

    $meta_time = get_post_meta($booking_id, "fw_option:approve_time", 1);
    if (!$meta_time || $meta_time == '') {
        update_post_meta($booking_id, "fw_option:approve_time", current_time("Y/m/d H:i"));
    }

    $meta_date = get_post_meta($booking_id, "fw_option:approve_person", 1);
    if (!$meta_date || $meta_date == '') {
        update_post_meta($booking_id, "fw_option:approve_person", wp_get_current_user()->nickname);
    }

}

add_action('init', function (){
    $array = [

        'message_confirm_before_delete_booking' => __('Do you want ot delete booking?', 'booking-system'),
        'message_already_booking' => __("already booking!\nPlease, choose another time.", 'booking-system'),
        'date_already_reserved' => __("Date already reserved!", 'booking-system'),
        'you_change_date' => __("You changed date to", 'booking-system'),

        'Sunday' => __("Sunday", 'booking-system'),
        'Monday' => __("Monday", 'booking-system'),
        'Wednesday' => __("Wednesday", 'booking-system'),
        'Thursday' => __("Thursday", 'booking-system'),
        'Friday' => __("Friday", 'booking-system'),
        'Saturday' => __("Saturday", 'booking-system'),

        'Sun' => __("Sun", 'booking-system'),
        'Mon' => __("Mon", 'booking-system'),
        'Tue' => __("Tue", 'booking-system'),
        'Wed' => __("Wed", 'booking-system'),
        'Thu' => __("Thu", 'booking-system'),
        'Fri' => __("Fri", 'booking-system'),
        'Sat' => __("Sat", 'booking-system'),

        'January' => __("January", 'booking-system'),
        'February' => __("February", 'booking-system'),
        'March' => __("March", 'booking-system'),
        'April' => __("April", 'booking-system'),
        'May' => __("May", 'booking-system'),
        'June' => __("June", 'booking-system'),
        'July' => __("July", 'booking-system'),
        'August' => __("August", 'booking-system'),
        'September' => __("September", 'booking-system'),
        'October' => __("October", 'booking-system'),
        'November' => __("November", 'booking-system'),
        'December' => __("December", 'booking-system'),

        'Jan' => __("Jan", 'booking-system'),
        'Feb' => __("Feb", 'booking-system'),
        'Mar' => __("Mar", 'booking-system'),
        'Apr' => __("Apr", 'booking-system'),
        'Jun' => __("Jun", 'booking-system'),
        'Jul' => __("Jul", 'booking-system'),
        'Aug' => __("Aug", 'booking-system'),
        'Sep' => __("Sep", 'booking-system'),
        'Oct' => __("Oct", 'booking-system'),
        'Nov' => __("Nov", 'booking-system'),
        'Dec' => __("Dec", 'booking-system'),

    ];

    wp_localize_script('jquery', 'bkng_messages', $array);
});


add_action( 'updated_post_meta', 'callback_update_bookin_meta', 10, 4);

function callback_update_bookin_meta($meta_id, $post_id, $meta_key, $meta_value ){

    if (get_post_type($post_id) != 'bookings')
        return;

    remove_action('updated_post_meta', 'callback_update_bookin_meta');

    if ($meta_key == 'fw_option:amount_price' || $meta_key == 'fw_option:discount'){
        updateRoomAmount($post_id);
    }elseif ($meta_key == 'fw_option:room_date' || $meta_key == 'fw_option:room_time'){
        updateRoomTimestamp($post_id);
    }

    add_action( 'updated_post_meta', 'callback_update_bookin_meta', 10, 4);

}

function updateRoomAmount($booking_id){
    $amount_price = get_post_meta($booking_id, 'fw_option:amount_price', 1);
    $discount = get_post_meta($booking_id, 'fw_option:discount', 1);
    if ($amount_price){
        update_post_meta($booking_id, 'amount', $amount_price - $amount_price * $discount / 100);
    }
}

function updateRoomQuantity($booking_id, $room_id, $amount_price){
    /**************************** Update Quantity *****************************/
    if ($amount_price){
        $prices = get_post_meta($room_id, "fw_option:prices", 1);
        if ($prices)
            foreach ($prices as $price){
                if ($price['price'] == $amount_price){
                    update_post_meta($booking_id, "fw_option:quantity", $price['quantity']);
                    break;
                }
            }
    }
}

function updateRoomTimestamp($booking_id){
    $date = get_post_meta($booking_id, 'fw_option:room_date', 1);
    $time = get_post_meta($booking_id, 'fw_option:room_time', 1);
    if ($date && $time) {
        $timestamp = DateTime::createFromFormat('d-m-Y H:i:s',"$date $time:00");
        if ($timestamp){
            update_post_meta($booking_id, 'room_date:timestamp', $timestamp->getTimestamp());
            update_post_meta($booking_id, 'room_date:week_day', $timestamp->format("D"));
        }
    }
}

function callback_post_options_update($booking_id){
    $name = get_post_meta($booking_id, "fw_option:name", 1);
    $room_id = get_post_meta($booking_id, "fw_option:room", 1);
    $room_name = get_the_title($room_id);
    $phone = get_post_meta($booking_id, "fw_option:phone", 1);
    $room_date = get_post_meta($booking_id, "fw_option:room_date", 1);
    $room_time = get_post_meta($booking_id, "fw_option:room_time", 1);
    $amount_price = get_post_meta($booking_id, "fw_option:amount_price", 1);


    $name = (!$name) ? '' : "$name |";
    $room_name = (!$room_name) ? '' : "$room_name |";
    $phone = (!$phone) ? '' : "$phone |";
    $room_date = (!$room_date) ? '' : "$room_date |";
    $room_time = (!$room_time) ? '' : "$room_time |";

    updateRoomTimestamp($booking_id);

    updateRoomAmount($booking_id);

    if ($amount_price)
        updateRoomQuantity($booking_id, $room_id, $amount_price);

    /*if ($amount_price){
        $prices = get_post_meta($room_id, "fw_option:prices", 1);
        foreach ($prices as $price){
            if ($price['price'] == $amount_price){
                update_post_meta($booking_id, "fw_option:quantity", $price['quantity']);
                break;
            }
        }
    }*/

    /**************************** Update Title *****************************/
    global $wpdb;
    $wpdb->update( $wpdb->posts, array( 'post_title' =>  "$room_name $room_date $room_time $name $phone" ), array( 'ID' => $booking_id ) );

    if (get_post_meta($booking_id, "fw_option:approve", 1) == 'on'){
        approveBookingData($booking_id);
    } else {
        update_post_meta($booking_id, "fw_option:approve_time", '');
        update_post_meta($booking_id, "fw_option:approve_person", '');
    }
    /**************************** *****************************/
}

add_action('save_post', '_action_theme_fw_post_options_update', 100, 1);
function _action_theme_fw_post_options_update($booking_id) {

    if ( ! wp_is_post_revision( $booking_id ) && get_post_type($booking_id) == 'bookings'){

        remove_action('save_post', '_action_theme_fw_post_options_update');

        callback_post_options_update($booking_id);

        add_action('save_post', '_action_theme_fw_post_options_update');
    }

}

add_action('admin_footer', function () {

    if (isset($_GET['post_type']) && $_GET['post_type'] == 'bookings') {

        global $wp_query;
        $attr = $wp_query->query;
        $attr['posts_per_page'] = -1;
//      $attr['meta_key'] = 'fw_option:canceled';
//      $attr['meta_value'] = '%';
//	    $attr['meta_compare'] = 'LIKE';
        $query = new WP_Query($attr);
        $posts = $query->posts;
        $summa = 0;
        foreach ($posts as $post) {
            if (get_post_meta($post->ID, 'fw_option:canceled', 1) == 'on')
                continue;
            $summa = $summa + (float)get_post_meta($post->ID, 'amount', true);
        }
        wp_reset_query();
        ?>
        <script type="application/javascript">
            var i, summ;
            var arr = jQuery('td.column-amount');
            summ = 0;
            for (i = 0; i < arr.length; i++) {
                if (!isNaN(parseInt(jQuery(arr[i]).html()))) {
                    summ = summ + parseFloat(jQuery(arr[i]).html());

                }
            }

            jQuery("#the-list").append(
                '<tr class="iedit author-other level-0 post-1394 type-booking status-publish hentry">' +
                '<th class="check-column"></th>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td style="font-weight: bold;">On Page:</td>' +
                '<td style="font-weight: bold;" class="title column-title has-row-actions column-primary page-title">' + summ + '</td>' +
                '</tr>');
            jQuery("#the-list").append(
                '<tr class="iedit author-other level-0 post-1394 type-booking status-publish hentry">' +
                '<th class="check-column"></th>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td ></td>' +
                '<td style="font-weight: bold;">Total:</td>' +
                '<td style="font-weight: bold;" class="title column-title has-row-actions column-primary page-title"><?=$summa; ?></td>' +
                '</tr>');
        </script>
        <?php
    }
});

add_action('restrict_manage_posts', function () {

    if (get_current_screen()->id != 'edit-bookings')
        return;

    global $wp_query;
    $query = clone $wp_query;
//    $query->query['posts_per_page'] = 99999;
    $posts = $query->get_posts();
    $arr = [];
    foreach ($posts as $post) {
        $arr [] = $post->ID;
    }

    echo "<button class='button export-xls' all-count='".count($posts)."'  data-query='".base64_encode(serialize($query->query))."' data-export='" . json_encode($arr) . "'>Export to XLS</button>";

    ?>
    <script>
        jQuery(document).ready(function ($) {
            jQuery(".export-xls").on("click", function (e) {
                e.preventDefault();
                var arr = (jQuery(this).attr('data-export'));
                var dataquery = (jQuery(this).attr('data-query'));

                jQuery.post(ajaxurl, {
                    action: 'bkng_export_xls',
                    ids: arr,
                    dataquery: dataquery
                }, function (result) {
                    window.location.href = result;
                });

            });
        });
    </script>
    <?php
}, 1);

add_action('wp_ajax_bkng_export_xls', 'bkng_export_xls_callback');
function bkng_export_xls_callback()
{

    $ids = (json_decode($_POST['ids']));
    $dataquery = base64_decode($_POST['dataquery']);
    $dataquery = unserialize($dataquery);
    $dataquery['posts_per_page'] = -1;
    $dataquery['post__in'] = $ids;

    $args = array(
        'post_type' => 'bookings',
        'post__in' => $ids,
        'posts_per_page' => -1
    );

    $query = new WP_Query($dataquery);
    bkng_export_xls($query->posts);

    wp_die();
}

function bkng_export_xls($posts)
{
    require_once __DIR__ . '/LibXLS/PHPExcel.php';
    require_once __DIR__ . '/LibXLS/PHPExcel/Writer/Excel5.php';
    //******************************************
    $xls = new PHPExcel();
    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();
    $sheet->setTitle("Booking");

    $sheet->setCellValue("A1", "חדרים"); // name
    $sheet->setCellValue("B1", "שם");   // name
    $sheet->setCellValue("C1", "טלפון");  // phone
    $sheet->setCellValue("D1", "דוא\"ל"); // email
    $sheet->setCellValue("E1", "מצב הזמנה"); //status
    $sheet->setCellValue("F1", "תאריך הזמנה"); // date
    $sheet->setCellValue("G1", "תאריך אישור הזמנה"); // date confirm
    $sheet->setCellValue("H1", "רשימת תפוצה"); // Invite רשימת תפוצה
    $sheet->setCellValue("I1", "מאשר הזמנה");   // Mailing
    $sheet->setCellValue("J1", "מחיר");         // Price  מחיר

    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);
    $sheet->getColumnDimension('J')->setAutoSize(true);


    $sheet->getStyle("A1")->getFont()->setBold(true);
    $sheet->getStyle("B1")->getFont()->setBold(true);
    $sheet->getStyle("C1")->getFont()->setBold(true);
    $sheet->getStyle("D1")->getFont()->setBold(true);
    $sheet->getStyle("E1")->getFont()->setBold(true);
    $sheet->getStyle("F1")->getFont()->setBold(true);
    $sheet->getStyle("G1")->getFont()->setBold(true);
    $sheet->getStyle("H1")->getFont()->setBold(true);
    $sheet->getStyle("I1")->getFont()->setBold(true);
    $sheet->getStyle("J1")->getFont()->setBold(true);


    $row = 3;
    $summa = 0;
    foreach ($posts as $post) {

        $post_status = '';
        $meta = get_all_meta_booking($post->ID);

        if ($meta['canceled'] == 'on')
            continue;

        if ($meta['frozen'] == 'on') {
            $post_status = 'מושבת';
        } else {
            $status = get_post_status($post->ID);
            if ($status == 'pending') $post_status = 'לא מאושר';
            if ($status == 'publish') $post_status = 'מאושר';
        }


        if ($meta['frozen'] == 'on') $subscr = 'כן'; else $subscr = 'לא';

        $sheet->setCellValue("A" . $row, $meta['room_name']);
        $sheet->setCellValue("B" . $row, $meta['name']);
        $sheet->setCellValue("C" . $row, $meta['phone']);
        $sheet->setCellValue("D" . $row, $meta['email']);

        $sheet->setCellValue("E" . $row, $post_status);
        $sheet->setCellValue("F" . $row, $post->post_date);
        $sheet->setCellValue("G" . $row, $meta['approve_time'] );
        $sheet->setCellValue("I" . $row, $meta['approve_person'] );
        $sheet->setCellValue("H" . $row, $subscr);
        $sheet->setCellValue("J" . $row, $meta['amount']);

        $summa = $summa + (float)$meta['amount'];

        $row++;
    }
    $sheet->setCellValue("J" . $row, $summa);
    $sheet->getStyle("J".$row)->getFont()->setBold(true);
    $objWriter = new PHPExcel_Writer_Excel5($xls);
    $objWriter->save(get_template_directory() . '/export.xls');
    echo get_template_directory_uri() . '/export.xls';
}

include __DIR__.'/mail_tpl/request.php';

add_action( 'wp_ajax_create_booking', 'callback_create_booking' );
add_action( 'wp_ajax_nopriv_create_booking', 'callback_create_booking' );
function callback_create_booking(){

    $fields = [];
    $fields['fw_option:room'] = (isset($_POST['room_id']) && (int)$_POST['room_id']) ? (int)$_POST['room_id'] : null;

    $fields['fw_option:name'] = (isset($_POST['name_booking']) && $_POST['name_booking']) ? $_POST['name_booking'] : null;
    $fields['fw_option:phone'] = (isset($_POST['phone_booking']) && $_POST['phone_booking']) ? $_POST['phone_booking'] : null;
    $fields['fw_option:email'] = (isset($_POST['email_booking']) && $_POST['email_booking']) ? $_POST['email_booking'] : null;

    $fields['fw_option:room_date'] = (isset($_POST['room_date']) && $_POST['room_date']) ? DateTime::createFromFormat('d-m-Y', $_POST['room_date'])->format('d-m-Y') : null;
    $fields['fw_option:room_time'] = (isset($_POST['room_time']) && $_POST['room_time']) ? $_POST['room_time'] : null;
    $fields['fw_option:subscription'] = (isset($_POST['subscription']) && ($_POST['subscription']) == 'true') ? 'on' : 'off';

    $fields['fw_option:canceled'] = 'off';
    $fields['fw_option:frozen'] = 'off';
    $fields['fw_option:approve'] = 'off';
    $fields['fw_option:approve_person'] = '';
    $fields['fw_option:approve_time'] = '';
    $fields['fw_option:quantity'] = 0;
    $fields['fw_option:discount'] = 0;
    $fields['fw_option:comments'] = '';

    $fields['fw_option:amount'] = (isset($_POST['price']) && $_POST['price']) ? $_POST['price'] : null;
    $fields['fw_option:amount_price'] = (isset($_POST['price']) && $_POST['price']) ? $_POST['price'] : null;

    if (check_room_for_booking($fields['fw_option:room'], $fields['fw_option:room_date'], $fields['fw_option:room_time'])) {
        return wp_send_json([], 400);
    }

    if (!$fields['fw_option:room']){
        return wp_send_json([], 400);
    }

    $response = create_booking($fields);
    send_email('new', $response['email'], get_all_meta_booking($response['booking_id']), false);

    wp_send_json(json_encode($response), 200);

}

function create_booking($fields){

    $response = [];

    $post_data = array(
        'post_status'   => 'publish',
        'post_type'     => 'bookings',
        'post_title'    => '',
        'post_content'  => '',
    );

    $fields['fw_option:user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $fields['fw_option:created_ip'] = $_SERVER['REMOTE_ADDR'];

    $post_id = wp_insert_post( $post_data );

    if ($post_id){

        foreach ($fields as $key => $val){
            if ($val !== null)
                update_post_meta($post_id, $key, $val);
        }

        callback_post_options_update($post_id);

        $response = get_all_meta_booking($post_id);

    }

    $user = get_current_user_id();
    bkng_write_log("User #".$user." CREATE booking #".$post_id." | Attr:".json_encode($response));

    return $response;
}


add_action( 'before_delete_post', 'before_delete_booking' );
function before_delete_booking( $booking_id ) {

    if (get_post_type($booking_id) != 'bookings')
        return;

    $response = get_all_meta_booking($booking_id);
    send_email('delete', $response['email'], get_all_meta_booking($booking_id), false);

}



add_filter( 'wp', 'disable_booking_types' );
function disable_booking_types()
{
    if (is_single() && (get_post_type() == 'bookings' || get_post_type() == 'room')) {
        wp_safe_redirect(site_url());
    }
}

add_action( 'wp_ajax_get_booking_by_room_date_time', 'callback_get_booking_by_room_date_time' );
add_action( 'wp_ajax_nopriv_get_booking_by_room_date_time', 'callback_get_booking_by_room_date_time' );
function callback_get_booking_by_room_date_time(){

    if (!isset($_POST['room_time']) || !isset($_POST['room_date']) || !isset($_POST['room_id'])){
        wp_send_json(json_encode(['result'=>false]), 200);
    }

    $query = new WP_Query([
        'posts_per_page' => -1,
        'post_type' =>  'bookings',
        'post_status' => 'publish',
        'meta_key' => 'fw_option:room_date',
        'meta_query' => array(
            'relation' => 'AND',
            [
                'key' => 'fw_option:room_date',
                'value' => $_POST['room_date'],
            ],
            [
                'key' => 'fw_option:room',
                'value' => $_POST['room_id'],
            ],
            [
                'key' => 'fw_option:room_time',
                'value' => $_POST['room_time'],
            ],
        ),
    ]);

    $posts = $query->post_count ? true : false;

    wp_send_json(json_encode(['result'=>$posts]), 200);
}


add_action( 'wp_ajax_find_client_by_phone', 'callback_find_client_by_phone' );
add_action( 'wp_ajax_nopriv_find_client_by_phone', 'callback_find_client_by_phone' );
function callback_find_client_by_phone(){
    if (!isset($_POST['phone'])){
        wp_send_json(json_encode(['result'=>false]), 200);
    }
    global $wpdb;
    $query = "SELECT `ID` FROM `{$wpdb->postmeta}` RIGHT JOIN `{$wpdb->posts}` ON `{$wpdb->posts}`.ID = `{$wpdb->postmeta}`.post_id WHERE post_type = 'bookings' AND meta_key = 'fw_option:phone' AND meta_value LIKE '{$_POST['phone']}%' LIMIT 0,10; ";
    $bookings = $wpdb->get_results($query);
    $result = [];
    foreach ($bookings as $booking){
        $result [] = get_all_meta_booking($booking->ID);
    }
    wp_send_json(json_encode($result), 200);
}

## Добавляем блоки в основную колонку на страницах постов и пост. страниц
add_action('add_meta_boxes', 'myplugin_add_custom_box');
function myplugin_add_custom_box(){
    $screens = array( 'bookings' );
    add_meta_box( 'myplugin_sectionid', 'Emails', 'myplugin_meta_box_callback', $screens, 'side' );
}

// HTML код блока
function myplugin_meta_box_callback( $post, $meta ){

    global $post;
    echo '<input type="hidden" id="test_mail" value="'.$post->ID.'">';
    echo '<button id="send_test_email" class="btn btn-success">Send Test Email To Admin</button>';
    echo '<div id="info_block" style="color: red;font-weight: bold;"></div>';
    $script = <<< EOF
    <script>
        jQuery("#send_test_email").click(function(){
            jQuery("#info_block").html('');
            var data = {
                action: "send_test_email",
                order_id: jQuery("#test_mail").val(), 
            };
            jQuery.post( ajaxurl, data, function(response) {
                jQuery("#info_block").html('Получено с сервера: ' + response);
            });
        });
    </script>
EOF;
    echo $script;
}


add_action( 'wp_ajax_send_test_email', 'send_test_email_callback' );
function send_test_email_callback() {
    $result = send_email('new', null, get_all_meta_booking($_POST['order_id']), true );
    if ($result){
        echo 'Message sent.';
    }else{
        echo 'Error during sending message.';
    }
    wp_die();
}


add_action('init', function (){
    if (isset($_GET['view_mail']) &&  $_GET['view_mail']){
        send_email('new', 'test@mail.com', get_all_meta_booking($_GET['view_mail']), false, true);
    }
    if (isset($_GET['send_test_mail']) &&  $_GET['send_test_mail']){
        send_email('new', 'test@mail.com', get_all_meta_booking($_GET['send_test_mail']), false, false);
    }
});

//add_action( 'pre_get_posts', 'exclude_category', 10, 1 );
function exclude_category( $query ) {
    if ($query->get('post_type') == 'bookings')
        $query->set( 'posts_per_page', 200 );
}