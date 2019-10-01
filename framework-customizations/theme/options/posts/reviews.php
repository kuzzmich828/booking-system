<?php

$options = array(
    'review_room' => [
        'type'  => 'select',
        'value' => '',
        'label' => __('Room', 'booking-system'),
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
}