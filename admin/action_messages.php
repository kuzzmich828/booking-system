<?php
add_action('admin_init', function () {
    if (is_admin()) {
        /****************** APPROVE ***********************/
        if (isset($_POST['approve_booking'])) {
            do_action('approve_booking_hook', $_POST['booking_id']);
            add_action('admin_notices', 'my_plugin_notice');
            function my_plugin_notice()
            {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?= "<b>#{$_POST['booking_id']}</b> ". __("Booking Approved!", 'bkng'); ?></p>
                </div>
                <?php
            }
        }
        /****************** SAVE ***********************/
        if (isset($_POST['bkng_action'])) {
            if ($_POST['bkng_action'] == 'save_booking') {
                do_action('edit_booking_hook', $_POST['booking_id']);
                add_action('admin_notices', 'my_plugin_notice');
                function my_plugin_notice()
                {
                    ?>
                    <div class="notice notice-success is-dismissible">
                        <p><?= "<b>#{$_POST['booking_id']}</b> ". __("Booking Saved!", 'bkng'); ?></p>
                    </div>
                    <?php
                }
            }
        }
        /****************** DELETE ***********************/
        if (isset($_POST['delete_booking'])) {
            do_action('delete_booking_hook', $_POST['booking_id']);
            add_action('admin_notices', 'my_plugin_notice');
            function my_plugin_notice()
            {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?= "<b>#{$_POST['booking_id']}</b> " . __("Booking Deleted!", 'bkng'); ?></p>
                </div>
                <?php
            }
        }
    }
});