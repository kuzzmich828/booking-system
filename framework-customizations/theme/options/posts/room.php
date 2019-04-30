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

    /***********************************/

    'wpcf-subtitle' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('Subtitle', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-subtitle',
        ),
    ],
    /*'wpcf-bg-color' => [
        'type'  => 'color-picker',
        'value' => '',
        'label' => __('Background color', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-bg-color',
        ),
    ],
    'wpcf-age-color' => [
        'type'  => 'color-picker',
        'value' => '',
        'label' => __('age color', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-age-color',
        ),
    ],
    'wpcf-text-color' => [
        'type'  => 'color-picker',
        'value' => '',
        'label' => __('text color', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-text-color',
        ),
    ],
    'wpcf-excerpt' => [
        'type'  => 'wp-editor',
        'value' => '',
        'label' => __('Excerpt', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-excerpt',
        ),
    ],*/

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



    'wpcf-order-age-icon' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('age icon', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-order-age-icon',
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

    /*
        'wpcf-secondary-thumbnail' => [
            'type'  => 'upload',
            'value' => '',
            'label' => __('secondary thumbnail', 'bkng'),
            'fw-storage' => array(
                'type' => 'post-meta',
                'post-meta' => 'wpcf-secondary-thumbnail',
            ),
        ],

        'wpcf-mobile-thumbnail' => [
            'type'  => 'upload',
            'value' => '',
            'label' => __('mobile thumbnail', 'bkng'),
            'fw-storage' => array(
                'type' => 'post-meta',
                'post-meta' => 'wpcf-mobile-thumbnail',
            ),
        ],
        'wpcf-background-thumbnail' => [
            'type'  => 'upload',
            'value' => '',
            'label' => __('background thumbnail', 'bkng'),
            'fw-storage' => array(
                'type' => 'post-meta',
                'post-meta' => 'wpcf-background-thumbnail',
            ),
        ],
        'wpcf-button-text' => [
            'type'  => 'text',
            'value' => '',
            'label' => __('button text', 'bkng'),
            'fw-storage' => array(
                'type' => 'post-meta',
                'post-meta' => 'wpcf-button-text',
            ),
        ],
        'wpcf-options' => [
            'type'  => 'wp-editor',
            'value' => '',
            'label' => __('options', 'bkng'),
            'fw-storage' => array(
                'type' => 'post-meta',
                'post-meta' => 'wpcf-options',
            ),
        ],

        'wpcf-flag-image' => [
            'type'  => 'upload',
            'value' => '',
            'label' => __('flag image', 'bkng'),
            'fw-storage' => array(
                'type' => 'post-meta',
                'post-meta' => 'wpcf-flag-image',
            ),
        ],

        'wpcf-new-text' => [
            'type'  => 'text',
            'value' => '',
            'label' => __('new text', 'bkng'),
            'fw-storage' => array(
                'type' => 'post-meta',
                'post-meta' => 'wpcf-new-text',
            ),
        ],*/
    'wpcf-percent-without-help' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('percent without help', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'wpcf-percent-without-help',
        ),
    ],


);



$times = get_times_format();

foreach ($times as $v) {
    $options['times']['choices'][$v] = $v;
}