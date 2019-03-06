<?php
/*
Plugin Name: Booking System
Plugin URI:
Description:
Author: Kuzin E.
Version: 0.1
*/
?><?php

require __DIR__.'/config.php';

register_activation_hook(__FILE__, 'bkng_active');

function bkng_active() {


}
/* end add func on activate plugin */

/* Hook for adding admin menus */
add_action('admin_menu', 'add_to_admin_menu_bkng');
function add_to_admin_menu_bkng(){
    add_submenu_page('edit.php?post_type=booking', __('Booking Calendar','bkng'), __('Booking Calendar','bkng'), 'administrator', 'booking-calendar', 'admin_page_booking_calendar');
}

if (is_admin() && $_GET['page'] == 'booking-calendar' )
    add_action('admin_enqueue_scripts', function () {
        wp_enqueue_style('calendar-css', plugin_dir_url(__FILE__) . '/calendar/css/style.css');
        wp_enqueue_style('calendar-google-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_style('bootstrapcdn-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');


        wp_enqueue_script('prefixfree-js', '//cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js', ['jquery']);
        wp_enqueue_script('jquery213', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', ['prefixfree-js']);
        wp_enqueue_script('jquery1112', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js', ['jquery213']);


        wp_enqueue_script('modernizr-js', plugin_dir_url(__FILE__) . '/calendar/js/modernizr-custom.js', ['jquery1112']);
        wp_enqueue_script('calendar-index-js', plugin_dir_url(__FILE__) . '/calendar/js/index.js', ['modernizr-js']);
        wp_enqueue_script('function-js', plugin_dir_url(__FILE__) . '/calendar/js/function.js', ['modernizr-js']);

    });

function admin_page_booking_calendar() {

    bkng_save_booking();






    include( __DIR__ . "/admin/admin_page_booking_calendar.php");
}
/* end Hook for adding admin menus */

register_uninstall_hook(__FILE__, 'bkng_deactive');

function bkng_deactive(){
}

require __DIR__.'/functions.php';

require __DIR__.'/hooks.php';

/** Add GitHub Updater **/
/*require __DIR__.'/plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/boosta-ltd/clone-detection-tt',
    __FILE__,
    'clone-detection-tt'
);
$myUpdateChecker->setAuthentication('b925e6124b99244e1109946f362217e9abbdf049');
$myUpdateChecker->setBranch('master');*/

/***************** *********************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_all_booking' );
function bkng_dashboard_widget_all_booking() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_all_booking', __( 'All Booking', 'bkng' ), 'bkng_dashboard_widget_all_booking_handler' );
}

function bkng_dashboard_widget_all_booking_handler() {
    echo "<h1>ALL</h1>";
}

/******************** ************************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_need_approve' );
function bkng_dashboard_widget_need_approve() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_need_approve', __( 'Need Approve', 'bkng' ), 'bkng_dashboard_widget_need_approve_handler' );
}

function bkng_dashboard_widget_need_approve_handler() {
    echo "<h1>Need Approve</h1>";
}

/******************** ************************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_frozen' );
function bkng_dashboard_widget_frozen() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_frozen', __( 'Frozen', 'bkng' ), 'bkng_dashboard_widget_frozen_handler' );
}

function bkng_dashboard_widget_frozen_handler() {
    ?>

    <div class="activity-block">
        <h3>Recently Published</h3>
        <ul>
            <li>
                <span>Feb 9th, 6:30 pm</span>
                <a href="http://booking.loc">Hello world!</a>
            </li>
        </ul>
        <button class="button button-primary">Edit</button>
        <button class="button button-warning">Delete</button>
    </div>

    <div class="activity-block">
        <h3>Recently Published</h3>
        <ul>
            <li>
                <span>Feb 9th, 6:30 pm</span>
                <a href="http://booking.loc">Hello world!</a>
            </li>
        </ul>
        <button class="button button-primary">Edit</button>
        <button class="button button-warning">Delete</button>
    </div>
    <div class="activity-block">
        <h3>Recently Published</h3>
        <ul>
            <li>
                <span>Feb 9th, 6:30 pm</span>
                <a href="http://booking.loc">Hello world!</a>
            </li>
        </ul>
        <button class="button button-primary">Edit</button>
        <button class="button button-warning">Delete</button>
    </div>

<?php
}

