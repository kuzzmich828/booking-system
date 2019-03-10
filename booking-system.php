<?php
/*
Plugin Name: Booking System
Plugin URI:
Description:
Author: Kuzin E.
Version: 0.1
*/
?><?php

register_activation_hook(__FILE__, 'bkng_active');

function bkng_active() {}
/* end add func on activate plugin */

/* Hook for adding admin menus */
add_action('admin_menu', 'add_to_admin_menu_bkng');
function add_to_admin_menu_bkng(){
    add_menu_page(__('Booking Calendar','bkng'), __('Booking Calendar','bkng'), 'administrator', 'booking-calendar', 'admin_page_booking_calendar', 'dashicons-calendar-alt', 5);
}

if (is_admin() && $_GET['page'] == 'booking-calendar' ) {
    add_action('admin_enqueue_scripts', function () {
        wp_enqueue_style('calendar-css', plugin_dir_url(__FILE__) . 'calendar/css/style.css');
        wp_enqueue_style('calendar-google-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_style('bootstrapcdn-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
        wp_enqueue_style('admin-page-css', plugin_dir_url(__FILE__) . 'calendar/css/admin-page.css');


        wp_enqueue_script('prefixfree-js', '//cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js', ['jquery']);
        wp_enqueue_script('jquery213', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', ['prefixfree-js']);
        wp_enqueue_script('jquery1112', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js', ['jquery213']);


        wp_enqueue_script('modernizr-js', plugin_dir_url(__FILE__) . 'calendar/js/modernizr-custom.js', ['jquery1112']);
        wp_enqueue_script('calendar-index-js', plugin_dir_url(__FILE__) . 'calendar/js/index.js', ['modernizr-js']);
        wp_enqueue_script('function-js', plugin_dir_url(__FILE__) . 'calendar/js/function_bkng.js', ['modernizr-js']);

    });
}

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('dashboard-bkng-js', plugin_dir_url(__FILE__) . 'calendar/js/dashboard_bkng.js', ['jquery']);
});
function admin_page_booking_calendar() {

    bkng_save_booking();

    include( __DIR__ . "/admin/admin_page_booking_calendar.php");
}
/* end Hook for adding admin menus */

register_uninstall_hook(__FILE__, 'bkng_deactive');

function bkng_deactive(){}




require __DIR__.'/functions.php';

require __DIR__.'/hooks.php';

require __DIR__.'/dashboard.php';

require __DIR__.'/action_messages.php';







/** Add GitHub Updater **/
/*require __DIR__.'/plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/boosta-ltd/clone-detection-tt',
    __FILE__,
    'clone-detection-tt'
);
$myUpdateChecker->setAuthentication('b925e6124b99244e1109946f362217e9abbdf049');
$myUpdateChecker->setBranch('master');*/


