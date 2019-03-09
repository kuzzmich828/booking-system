<?php
add_action('admin_init', function () {
    if (is_admin()) {
        /****************** ***********************/
        if (isset($_POST['approve_booking'])) {
            do_action('approve_booking_hook', $_POST['booking_id']);
            add_action('admin_notices', 'my_plugin_notice');
            function my_plugin_notice()
            {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?= __("Booking <b>#{$_POST['booking_id']}</b> Approved!", 'bkng'); ?></p>
                </div>
                <?php
            }

        }
        /****************** ***********************/
        if (isset($_POST['bkng_action'])) {
            if ($_POST['bkng_action'] == 'save_booking') {
                add_action('admin_notices', 'my_plugin_notice');
                function my_plugin_notice()
                {
                    ?>
                    <div class="notice notice-success is-dismissible">
                        <p><?= __("Booking <b>#{$_POST['booking_id']}</b> Saved!", 'bkng'); ?></p>
                    </div>
                    <?php
                }
            }
        }
        /****************** ***********************/
    }
});