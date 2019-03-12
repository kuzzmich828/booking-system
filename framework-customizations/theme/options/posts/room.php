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
    )

);



$times = get_times_format();

foreach ($times as $v) {
    $options['times']['choices'][$v] = $v;
}