<?php

$options = array(

    'times' => array(
        'type'  => 'multi-select',
        'label' =>  __('Times', 'bkng') ,

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
        'label' => __('Quantity & Price', 'bkng'),
        'box-options' => array(
            'quantity' => array( 'type' => 'text' ),
            'price' => array( 'type' => 'text' ),
        ),
        'template' => 'Quantity:{{- quantity }}    Price:{{- price }}',
        'limit' => 10,
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:prices',
        ),
    ),


    /********* ICON ************/
    'wpcf-order-complexity-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('complexity icon', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-order-complexity-icon',
        ),
    ],
    'wpcf-complexity' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('complexity text', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-complexity',
        ),
    ],



    'wpcf-people-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('people icon', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-people-icon',
        ),
    ],
    'wpcf-people' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('people text', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-people',
        ),
    ],


    'wpcf-order-time-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('time icon', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-order-time-icon',
        ),
    ],
    'wpcf-time' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('time text', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-time',
        ),
    ],

    'wpcf-age' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('age text', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-age',
        ),
    ],

    'wpcf-order-age-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('age icon', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-order-age-icon',
        ),
    ],

    'wpcf-icon-text-color' => [
        'type'  => 'color-picker',
        'value' => '#ccc',
        'label' => __('Text Color Icon', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-icon-text-color',
        ),
    ],

    'wpcf-percent-without-help' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('percent without help', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-percent-without-help',
        ),
    ],

    'room_bg_image' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('Backgroung Modal Image', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:room_bg_image',
        ),
    ],


);



$times = get_times_format();

foreach ($times as $v) {
    $options['times']['choices'][$v] = $v;
}