<?php
/*
Plugin Name: Booking System Esc
Plugin URI:
Description: Booking System Esc
Author: kuzzmich
Version: 2.5
*/

register_activation_hook(__FILE__, 'bkng_active');

function bkng_active() {

    /********** Copy files to THEME **********/
    rcopy(plugin_dir_path(__FILE__).'framework-customizations', get_template_directory().'/framework-customizations');

}
/* end add func on activate plugin */

/* Hook for adding admin menus */
add_action('admin_menu', 'add_to_admin_menu_bkng');
function add_to_admin_menu_bkng(){

    add_menu_page(__('Booking Calendar','booking-system'), __('Booking Calendar','booking-system'), 'edit_others_posts' , 'booking-calendar', 'admin_page_booking_calendar', 'dashicons-calendar-alt', 5);
}

if (is_admin() && isset($_GET['page']) && $_GET['page'] == 'booking-calendar' ) {
    add_action('admin_enqueue_scripts', function () {
        wp_enqueue_style('calendar-css', plugin_dir_url(__FILE__) . 'calendar/css/style.css', [], '1.1');
        wp_enqueue_style('calendar-google-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css', [], '1.2');
        wp_enqueue_style('bootstrapcdn-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', [], '1.2');
        wp_enqueue_style('admin-page-css', plugin_dir_url(__FILE__) . 'calendar/css/admin-page.css', [], filemtime(__DIR__.'/calendar/css/admin-page.css'));

        wp_enqueue_script('prefixfree-js', '//cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js', ['jquery'], '1.2');
        wp_enqueue_script('jquery213', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', ['prefixfree-js'], '1.2');
        wp_enqueue_script('jquery1112', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js', ['jquery213'], '1.2');

        wp_enqueue_script('modernizr-js', plugin_dir_url(__FILE__) . 'calendar/js/modernizr-custom.js', ['jquery1112'], '1.2');
        wp_enqueue_script('calendar-index-js', plugin_dir_url(__FILE__) . 'calendar/js/index.js', ['modernizr-js'], filemtime(__DIR__.'/calendar/js/index.js'));
        wp_enqueue_script('function-js', plugin_dir_url(__FILE__) . 'calendar/js/function_bkng.js', ['modernizr-js'], filemtime(__DIR__.'/calendar/js/function_bkng.js'));

    });

    add_action('admin_head', function(){
        ?>
        <style>
            @font-face {
                font-family: 'assistantregular';
                src: url('<?= get_template_directory_uri(); ?>/fonts/assistant-regular-webfont.eot');
                src: url('<?= get_template_directory_uri(); ?>/fonts/assistant-regular-webfont.eot?#iefix') format('embedded-opentype'),
                url('<?= get_template_directory_uri(); ?>/fonts/assistant-regular-webfont.woff2') format('woff2'),
                url('<?= get_template_directory_uri(); ?>/fonts/assistant-regular-webfont.woff') format('woff'),
                url('<?= get_template_directory_uri(); ?>/fonts/assistant-regular-webfont.ttf') format('truetype'),
                url('<?= get_template_directory_uri(); ?>/fonts/assistant-regular-webfont.svg#assistantregular') format('svg');
                font-weight: normal;
                font-style: normal;
            }
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                font-size: 13px;
                line-height: 1.4em;
                min-width: 600px;
            }

            .wrap-calendar-admin{
                font-family: 'assistantregular' !important;
            }

            .btn {
                border-radius: 0 !important;
                font-weight: bold;
            }
        </style>
        <?php
    });
}


add_action('admin_head', function(){
    if (get_current_screen()->id != 'dashboard')
        return;
    ?><style>
        .button {
            border-radius: 0 !important;
            box-shadow: none !important;
        }
    </style>
    <?php
});

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('dashboard-bkng-js', plugin_dir_url(__FILE__) . 'calendar/js/dashboard_bkng.js', ['jquery'], filemtime(__DIR__.'/calendar/js/dashboard_bkng.js'));
});
function admin_page_booking_calendar() {
    include( __DIR__ . "/admin/admin_page_booking_calendar.php");
}
/* end Hook for adding admin menus */

add_action('edit_booking_hook', 'bkng_save_booking');

register_uninstall_hook(__FILE__, 'bkng_deactive');

function bkng_deactive(){
    delTree(get_template_directory().'/framework-customizations');
}

add_action( 'plugins_loaded', function () {
    load_plugin_textdomain('booking-system', true, dirname(plugin_basename(__FILE__)) . '/languages/');
});

require __DIR__.'/functions.php';

require __DIR__.'/hooks.php';

require __DIR__ . '/admin/dashboard.php';

require __DIR__ . '/admin/action_messages.php';

require __DIR__ . '/admin/table_columns.php';

require __DIR__ . '/admin/table_filters.php';

require __DIR__ . '/frontend/shortcode.php';
