<?php
add_action('admin_init', function () {
    if (is_admin()) {

        /****************** SAVE ***********************/
        if (isset($_POST['bkng_action'])) {
            if ($_POST['bkng_action'] == 'save_booking') {

//                do_action('edit_booking_hook', $_POST['booking_id']);
                global $is_saved;
                $is_saved = bkng_save_booking();
                add_action('admin_notices', 'my_plugin_notice_save');
                function my_plugin_notice_save()
                {
                    global $is_saved;
                    if ($is_saved)
                        $message = __("Booking Saved!", 'bkng');
                    else
                        $message = __("ERROR during the saving! This time already exist!", 'bkng');
                    ?>
                    <div class="notice notice-success is-dismissible">
                        <p><?= "<b>#{$_POST['booking_id']}</b> ". $message; ?></p>
                    </div>
                    <?php
                }
            }
        }
        /****************** DELETE ***********************/
        if (isset($_POST['delete_booking'])) { 
            do_action('delete_booking_hook', $_POST['delete_booking']);
            add_action('admin_notices', 'my_plugin_notice_delete');
            function my_plugin_notice_delete()
            {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?= "<b>#{$_POST['delete_booking']}</b> " . __("Booking Deleted!", 'bkng'); ?></p>
                </div>
                <?php
            }
        }
        /****************** APPROVE ***********************/
        if (isset($_POST['approve_booking'])) {
            do_action('approve_booking_hook', $_POST['booking_id']);
            add_action('admin_notices', 'my_plugin_notice_approve');
            function my_plugin_notice_approve()
            {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?= "<b>#{$_POST['booking_id']}</b> ". __("Booking Approved!", 'bkng'); ?></p>
                </div>
                <?php
            }
        }
    }
});