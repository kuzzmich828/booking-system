<?php

add_action('init', 'bkng_register_posts_type');
function bkng_register_posts_type(){
    register_post_type('room', array(
        'labels'             => array(
            'name'               => __('Rooms', 'bkng'),
            'singular_name'      => __('Room', 'bkng'),
            'add_new'            => __('Add new', 'bkng'),
            'add_new_item'       => __('Add new', 'bkng'),
            'edit_item'          => __('Edit', 'bkng'),
            'new_item'           => __('New room', 'bkng'),
            'view_item'          => __('View', 'bkng'),
            'search_items'       => __('Find', 'bkng'),
            'not_found'          =>  __('Not found', 'bkng'),
            'not_found_in_trash' => __('Not found', 'bkng'),
            'parent_item_colon'  => '',
            'menu_name'          => __('Rooms', 'bkng')

        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 4,
        'menu_icon'          => 'dashicons-grid-view',
        'supports'           => array('title','author','thumbnail')
    ) );

    register_post_type('booking', array(
        'labels'             => array(
            'name'               => __('Booking', 'bkng'),
            'singular_name'      => __('Booking', 'bkng'),
            'add_new'            => __('Add new', 'bkng'),
            'add_new_item'       => __('Add new', 'bkng'),
            'edit_item'          => __('Edit', 'bkng'),
            'new_item'           => __('New', 'bkng'),
            'view_item'          => __('View', 'bkng'),
            'search_items'       => __('Find', 'bkng'),
            'not_found'          =>  __('Not found', 'bkng'),
            'not_found_in_trash' => __('Not found', 'bkng'),
            'parent_item_colon'  => '',
            'menu_name'          => __('Booking', 'bkng')

        ),

        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 4,
        'menu_icon'          => 'dashicons-feedback',
        'supports'           => array('title','author', )
    ) );

}

add_action( 'wp_ajax_get_booking_rooms', 'callback_get_booking_rooms' );
add_action( 'wp_ajax_nopriv_get_booking_rooms', 'callback_get_booking_rooms' );
function callback_get_booking_rooms(){

    $rooms = get_posts([
        'post_type'=>'booking',
        'post_status'=>'publish',
    ]);

    wp_send_json(json_encode($rooms), 200);
}

add_action( 'wp_ajax_get_room_times', 'callback_get_room_times' );
add_action( 'wp_ajax_nopriv_get_room_times', 'callback_get_room_times' );
function callback_get_room_times(){
    $times = get_post_meta($_POST['id'], 'fw_option:times', 1);
    wp_send_json(json_encode($times), 200);
}

add_action('save_post', '_action_theme_fw_post_options_update', 10, 1);
function _action_theme_fw_post_options_update($booking_id) {


    if (get_post_meta($booking_id, "fw_option:approve", 1) == 'on'){

        approveBookingData($booking_id);

    } else {
        update_post_meta($booking_id, "fw_option:approve_time", '');
        update_post_meta($booking_id, "fw_option:approve_person", '');
    }

}


add_action( 'wp_ajax_get_booking_room_date', 'callback_get_booking_room_date' );
add_action( 'wp_ajax_nopriv_get_booking_room_date', 'callback_get_booking_room_date' );
function callback_get_booking_room_date(){

    $query = new WP_Query([
        'post_type' =>  'booking',
        'post_status' => 'publish',
        'meta_key' => 'fw_option:room_date',
        'meta_query' => array(
            'relation' => 'AND',
            [
                'key' => 'fw_option:room_date',
                'value' => $_POST['date'],
            ],
            [
                'key' => 'fw_option:room',
                'value' => $_POST['room_id'],
            ],
        ),
    ]);

    $posts = $query->get_posts();
    $times = [];

    foreach ($posts as $post){
         $times [] = get_post_meta($post->ID, "fw_option:room_time", true);
    }

    wp_send_json(json_encode($times), 200);

}

add_action( 'wp_ajax_get_room_attributes', 'callback_get_room_attributes' );
add_action( 'wp_ajax_nopriv_get_room_attributes', 'callback_get_room_attributes' );
function callback_get_room_attributes(){

    $times = get_post_meta($_POST['id'], 'fw_option:times', 1);
    $pq = get_post_meta($_POST['id'], 'fw_option:prices', 1);
    $data = [];
    $data ['times'] = $times;
    $data ['prices'] = $pq;

    wp_send_json(json_encode($data), 200);
}

add_action( 'wp_ajax_get_booking_rooms_by_date', 'callback_get_booking_rooms_by_date' );
add_action( 'wp_ajax_nopriv_get_booking_rooms_by_date', 'callback_get_booking_rooms_by_date' );
function callback_get_booking_rooms_by_date(){

    $response = [];

    if ($_POST['date']) {

        $date = DateTime::createFromFormat('d-m-Y', $_POST['date']);

        $bookings = get_posts([
            'post_type' => 'booking',
            'post_status' => 'publish',
            'meta_key' => 'fw_option:room_date',
            'meta_query' => array(
                'relation' => 'AND',
                [
                    'key' => 'fw_option:room_date',
                    'value' => $date->format("d-m-Y"),
                ],
            ),
        ]);

        foreach ($bookings as $booking){
            $room_id = get_post_meta($booking->ID, 'fw_option:room', 1);
            $response [] = [
                'id'    => $booking->ID,
                'room_id'    => $room_id,
                'room_time' => get_post_meta($booking->ID, 'fw_option:room_time', 1),
                'room_name'    => get_the_title(get_post_meta($booking->ID, 'fw_option:room', 1)),
                'room_times'    => get_post_meta($room_id, 'fw_option:times', 1),
            ];
        }

    }

    wp_send_json(json_encode($response), 200);
}

add_action( 'wp_ajax_get_booking', 'callback_get_booking' );
add_action( 'wp_ajax_nopriv_get_booking', 'callback_get_booking' );
function callback_get_booking(){

    $bookings = get_posts([
        'post_type'=>'booking',
        'post__in' => [$_POST['booking_id']]
    ]);

    $response = '';
    if (count($bookings) > 0 && $bookings[0]->ID){
        $id = $bookings[0]->ID;
        $response  = get_all_meta_booking($id);
    }

    wp_send_json(json_encode($response), 200);

}

add_action('approve_booking_hook', function ($booking_id){
    update_post_meta($booking_id, 'fw_option:approve', 'on');
    approveBookingData($booking_id);
});

add_action('admin_footer', function (){
    ?>
    <style>
        .wp-core-ui .button-delete{background: #d61111c4; color: #fff; border-color: #c70000; box-shadow: 0 1px 0 #ff3636;}
        .wp-core-ui .button-approve{background: #f7ff20b5; color: #4a4a4a; border-color: #4a4a4a; box-shadow: 0 1px 0 #0a7b00b5;}
    </style>
<?php
});

function approveBookingData($booking_id){
    if (get_post_meta($booking_id, "fw_option:approve_time", 1) == '') {
        update_post_meta($booking_id, "fw_option:approve_time", date("Y/m/d H:i"));
    }
    if (get_post_meta($booking_id, "fw_option:approve_person", 1) == '') {
        update_post_meta($booking_id, "fw_option:approve_person", wp_get_current_user()->nickname);
    }
}