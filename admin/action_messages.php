<?php
add_action('admin_init', function () {
    if (is_admin()) {

        /****************** SAVE ***********************/
        if (isset($_POST['bkng_action'])) {
            if ($_POST['bkng_action'] == 'save_booking') {

                global $is_saved;
                $is_saved = bkng_save_booking();
                add_action('admin_notices', 'my_plugin_notice_save');
                function my_plugin_notice_save()
                {
                    global $is_saved;
                    $class = '';
                    if ($is_saved) {
                        $message = __("Booking Saved!", 'booking-system');
                    }else {
                        $class = 'error-admin';
                        $message = __("ERROR during the saving! This time already exist!", 'booking-system');
                    }
                    ?>
                    <div class="notice notice-success is-dismissible <?= $class; ?>">
                        <p><?= "<b>#{$_POST['booking_id']}</b> ". $message; ?></p>
                    </div>
                    <style>
                        .error-admin, .error-admin p{background: #ff0000bf;color: white;}
                    </style>
                    <?php
                }
            }
        }
        /****************** DELETE ***********************/
        if (isset($_POST['delete_booking']) && $_POST['delete_booking']) {
            do_action('delete_booking_hook', $_POST['delete_booking']);
            add_action('admin_notices', 'my_plugin_notice_delete');
            function my_plugin_notice_delete()
            {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?= "<b>#{$_POST['delete_booking']}</b> " . __("Booking Deleted!", 'booking-system'); ?></p>
                </div>
                <?php
            }
        }
        /****************** APPROVE ***********************/
        if (isset($_POST['approve_booking']) && isset($_POST['booking_id']) && isset($_POST['booking_id'])
                && $_POST['booking_id'] && $_POST['approve_booking']) {
            do_action('approve_booking_hook', $_POST['booking_id']);
            add_action('admin_notices', 'my_plugin_notice_approve');
            function my_plugin_notice_approve()
            {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?= "<b>#{$_POST['booking_id']}</b> ". __("Booking Approved!", 'booking-system'); ?></p>
                </div>
                <?php
            }
        }
    }
});