<?php

$options = array(

    'order-room' => [
        'type'  => 'text',
        'value' => '10',
        'label' => __('Order room on home page', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'order-room',
        ),
    ],

);
