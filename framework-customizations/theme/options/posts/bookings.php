<?php

$options = array(

    'room' => array(
        'type'  => 'select',
        'choices' => array(),
        'label' =>  __('Room', 'booking-system'),
        'value' => '',
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:room',
        ),
        'desc' => __('Choose a room from list', 'booking-system'),
    ),

    'room_date' => array(
        'type'  => 'date-picker',
        'label' =>  __('Date', 'booking-system') ,
        'min-date' => "01-01-2019",
        'max-date' => null,

//        'attr'  => array(  'disabled' => 'true' ),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:room_date',
        ),
        'desc' => __('Choose booking date', 'booking-system'),
    ),

    'room_time' => array(
        'type'  => 'select',
        'choices' => array('no'=>'---'),
        'label' =>  __('Time', 'booking-system'),
        'value' => '',
//        'attr'  => array(  'disabled' => 'true' ),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:room_time',
        ),
        'desc' => __('Choose booking time', 'booking-system'),
    ),



    'name' => array(
        'type'  => 'text',
        'label' =>  __('Name', 'booking-system') ,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:name',
        ),
        'desc' => __('Choose booking name', 'booking-system'),
    ),

    'phone' => array(
        'type'  => 'text',
        'label' =>  __('Phone', 'booking-system') ,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:phone',
        ),
        'desc' => __('Choose booking phone', 'booking-system'),
    ),

    'email' => array(
        'type'  => 'text',
        'label' =>  __('Email', 'booking-system') ,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:email',
        ),
        'desc' => __('Choose booking email', 'booking-system'),
    ),

    'comments' => array(
        'type'  => 'textarea',
        'label' =>  __('Comments', 'booking-system') ,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:comments',
        ),
        'desc' => __('Type your comment', 'booking-system'),
    ),

    'discount' => array(
        'type'  => 'select',
        'label' =>  __('Discount', 'booking-system') ,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:discount',
        ),
        'desc' => __('Choose discount', 'booking-system'),
    ),

    'amount_price' => array(
        'type'  => 'select',
        'label' =>  __('Amount Price', 'booking-system') ,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:amount_price',
        ),
    ),

    /*'amount' => array(
        'type'  => 'text',
        'attr'  => array(  'disabled' => 'true' ),
        'label' =>  __('Amount', 'booking-system') ,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:amount',
        ),
    ),*/

    /*
        'quantity' => array(
            'type'  => 'select',
            'label' =>  __('Quantity', 'booking-system') ,
            'fw-storage' => array(
                'type' => 'post-meta',
                'post-meta' => 'fw_option:quantity',
            ),
        ),
    */
    'frozen' => array(
        'type'  => 'switch',
        'label' =>  __('Frozen', 'booking-system') ,
        'value' => 'off',
        'left-choice' => array(
            'value' => 'on',
            'label' => __('Yes', 'booking-system'),
        ),
        'right-choice' => array(
            'value' => 'off',
            'label' => __('No', 'booking-system'),
        ),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:frozen',
        ),
    ),

    'approve' => array(
        'type'  => 'switch',
        'label' =>  __('Approve', 'booking-system') ,
        'value' => 'off',

        'right-choice' => array(
            'value' => 'off',
            'label' => __('No', 'booking-system'),
        ),
        'left-choice' => array(
            'value' => 'on',
            'label' => __('Yes', 'booking-system'),
        ),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:approve',
        ),
    ),

    'approve_time' => array(
        'type'  => 'text',
        'label' =>  __('Approve Time', 'booking-system') ,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:approve_time',
        ),
    ),

    'approve_person' => array(
        'type'  => 'text',
        'label' =>  __('Approve Person', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:approve_person',
        ),
    ),

);

/*********** Rooms **********/
$rooms = get_posts([
    'posts_per_page'=>-1,
    'post_type'=>'room',
    'post_status'=>'publish'
]);

$options['room']['choices'][''] = '---';
$options['amount_price']['choices'][''] = '-';
foreach ($rooms as $room){
    $options['room']['choices'][$room->ID] = $room->post_title;

    $times = get_post_meta($room->ID, 'fw_option:times', 1);
    $prices = get_post_meta($room->ID, 'fw_option:prices', 1);


    if (is_array($times)) {
        foreach ($times as $t => $v) {
            $options['room_time']['choices'][$v] = $v;
        }
    }

    if (is_array($prices)) {
        foreach ($prices as $v) {
            $options['amount_price']['choices'][$v['price']] = $v['quantity'] . ' - ' . $v['price'];
        }
    }
}


/************ Fill Time & Price ***********/
$id = get_the_ID();
if ($id) {
    $room_id = get_post_meta($id, 'fw_option:room', 1);
    $times = get_post_meta($room_id, 'fw_option:times', 1);
    $prices = get_post_meta($room_id, 'fw_option:prices', 1);

    if (is_array($times))
        foreach ($times as $t => $v) {
            $options['room_time']['choices'][$v] = $v;
        }

    if (is_array($prices))
        foreach ($prices as $v) {
            $options['amount_price']['choices'][$v['price']] = $v['quantity'] . ' - ' . $v['price'];
        }
}

/************ Fill Discounts ***********/
for ($k = 0; $k < 100; $k++){
    if ($k % 5 == 0){
        $options['discount']['choices'][$k] = $k . '%';
    }
}

add_action('admin_enqueue_scripts', function (){
    wp_enqueue_script('admin-booking-js',content_url('plugins/booking-system/').'/../calendar/js/admin.js', ['jquery']);
});