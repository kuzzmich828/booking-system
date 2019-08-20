<?php

$options = array(
    'review_room' => [
        'type'  => 'select',
        'value' => '',
        'label' => __('Room', 'bkng'),
        'fw-storage' => array(
            'type' => 'post-meta',
            'post-meta' => 'review_room',
        ),
    ],
);

/*********** Rooms **********/
$rooms = get_posts([
    'post_type'=>'room',
    'post_status'=>'publish',
    'posts_per_page' =>-1
]);

$options['review_room']['choices'][''] = '---';
foreach ($rooms as $room){
    $options['review_room']['choices'][$room->ID] = $room->post_title;

    $times = get_post_meta($room->ID, 'fw_option:times', 1);
    $prices = get_post_meta($room->ID, 'fw_option:prices', 1);

    if (is_array($times)) {
        foreach ($times as $t => $v) {
            $options['room_time']['choices'][$v] = $v;
        }
    }

}
