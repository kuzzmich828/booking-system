<?php

add_shortcode('booking_system', 'bkng_shortcode_callback');
function bkng_shortcode_callback(){
    include __DIR__ . '/calendar.php';
}
