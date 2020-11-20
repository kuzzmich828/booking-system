<?php

$options = array(

    'times' => array(
        'type'  => 'multi-select',
        'label' =>  __('Times', 'booking-system') ,

        'population' => 'array',

        'source' => '',

        'prepopulate' => 10,

        'choices' => array(),

        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:times',
        ),

    ),

    'prices' => array(
        'type'  => 'addable-box',
        'value' => array(
            array(
                'quantity' => '',
                'price' => '',
            )
        ),
        'label' => __('Quantity & Price', 'booking-system'),
        'box-options' => array(
            'quantity' => array( 'type' => 'text' ),
            'price' => array( 'type' => 'text' ),
        ),
        'template' => 'Quantity {{- quantity}} Price {{- price}}',
        'limit' => 10,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:prices',
        ),
    ),

    'department' => array(
        'type'  => 'text',
        'label' =>  __('Department', 'booking-system') ,
    ),

    'email' => array(
        'type'  => 'text',
        'label' =>  __('Department', 'booking-system') ,
    ),

    'roomcontent' => array(
        'type'  => 'select',
        'label' =>  __('Room Content', 'booking-system') ,
        'choices' => array( ),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option-room-content',
        ),
    ),

    /********* ICON ************/
    'wpcf-order-complexity-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('complexity icon', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-order-complexity-icon',
        ),
    ],
    'wpcf-complexity' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('complexity text', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-complexity',
        ),
    ],



    'wpcf-people-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('people icon', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-people-icon',
        ),
    ],
    'wpcf-people' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('people text', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-people',
        ),
    ],


    'wpcf-order-time-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('time icon', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-order-time-icon',
        ),
    ],
    'wpcf-time' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('time text', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-time',
        ),
    ],

    'wpcf-age' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('age text', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-age',
        ),
    ],

    'wpcf-order-age-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('age icon', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-order-age-icon',
        ),
    ],

    'wpcf-icon-text-color' => [
        'type'  => 'color-picker',
        'value' => '#ccc',
        'label' => __('Text Color Icon', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-icon-text-color',
        ),
    ],

    'wpcf-percent-without-help' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('percent without help', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-percent-without-help',
        ),
    ],

    'room_bg_image' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('Backgroung Modal Image', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:room_bg_image',
        ),
    ],

    'background_color' => [
        'type'  => 'color-picker',
        'value' => '#ccc',
        'label' => __('Background Color', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:background_color',
        ),
    ],

    'modal_corner_color' => [
        'type'  => 'color-picker',
        'value' => '#ccc',
        'label' => __('Modal Corner Color', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:modal_corner_color',
        ),
    ],

);

$times = get_times_format();

foreach ($times as $v) {
    $options['times']['choices'][$v] = $v;
}

$roomcontents = get_posts([
    'post_type'  =>  'roomcontent',
    'status'    =>  'publish'
]);
$options['roomcontent']['choices']['-'] = '-';
foreach ($roomcontents as $roomcontent) {
    $options['roomcontent']['choices'][$roomcontent->ID] = $roomcontent->post_title;
}
