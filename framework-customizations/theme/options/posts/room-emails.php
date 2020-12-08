<?php

$options = array(

    'main_logo' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('Main Logo', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:main_logo',
        ),
    ],

    'header_new_order_text' => [
        'type'  => 'wp-editor',
        'value' => '',
        'label' => __('Header Text (New Order)', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:header_new_order_text',
        ),
    ],

    'header_confirm_order_text' => [
        'type'  => 'wp-editor',
        'value' => '',
        'label' => __('Header Text (Confirmation)', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:header_confirm_order_text',
        ),
    ],

    'header_delete_order_text' => [
        'type'  => 'wp-editor',
        'value' => '',
        'label' => __('Header Text (Delete Order)', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:header_delete_order_text',
        ),
    ],

    'banner_image' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('Block 2: Banner Image', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:banner_image',
        ),
    ],

    'banner_caption' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('Block 2: Banner Caption', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:banner_caption',
        ),
    ],

    'block_3_content' => [
        'type'  => 'wp-editor',
        'value' => '',
        'label' => __('Block 3: Content', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:block_3_content',
        ),
    ],

    'block_4_content' => [
        'type'  => 'wp-editor',
        'value' => '',
        'label' => __('Block 4: Content', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:block_4_content',
        ),
    ],

    'footer_links' => [
        'type'  => 'addable-box',
        'label' => __('Footer Menu (Links)', 'booking-system'),
        'box-options' => array(
            'label' => array( 'type' => 'text' ),
            'link' => array( 'type' => 'text' ),
        ),
        'template' => '{{- label}}',
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:footer_links',
        ),
    ],

    'footer_logo' => [
        'type'  => 'upload',
        'value' => '',
        'label' => __('Footer Logo', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:footer_logo',
        ),
    ],

    'phone_1' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('Phone 1', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:phone_1',
        ),
    ],
    'phone_2' => [
        'type'  => 'text',
        'value' => '',
        'label' => __('Phone 2', 'booking-system'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'fw_option:phone_2',
        ),
    ],


);

