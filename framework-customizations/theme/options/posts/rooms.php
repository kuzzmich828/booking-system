<?php

$options = array(

    'order-room' => [
        'type'  => 'text',
        'value' => '10',
        'label' => __('Order room on home page', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'order-room',
        ),
    ],

);
