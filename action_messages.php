<?php

if (is_admin() && isset($_GET['approve_booking'])) {
    add_action('admin_notices', 'my_plugin_notice');
    function my_plugin_notice()
    {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?= __('Booking <b>#'.$_GET['approve_booking'].'</b> Approved!', 'bkng'); ?></p>
        </div>
        <?php
    }
}

if (is_admin() && isset($_POST['bkng_action'])){
    if ($_POST['bkng_action'] == 'save_booking'){
        add_action('admin_notices', 'my_plugin_notice');
        function my_plugin_notice()
        {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?= __('Booking <b>#'.$_POST['booking_id'].'</b> Saved!', 'bkng'); ?></p>
            </div>
            <?php
        }
    }
}