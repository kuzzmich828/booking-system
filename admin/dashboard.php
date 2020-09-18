<?php
global $all_bookings;
/********** Write widget for every room ************/

add_action( 'wp_dashboard_setup', function () {

    if (check_capability_other_button())
        return;

    $posts = get_posts([
        'post_type'=>'room',
        'numberposts'=> -1,
        'post_status'=> 'publish'
    ]);

    if ($posts)
        foreach ($posts as $post) {

            wp_add_dashboard_widget('bkng_dashboard_widget_room_' . $post->ID, $post->post_title, function () use ($post) {
                global $all_bookings;
                if (!$all_bookings)
                    $all_bookings = get_booking_after_date(current_time('d-m-Y'), current_time('H:i'), 'off', 'on');

                foreach ($all_bookings as $booking):
                    if ($booking['room_id'] != $post->ID)
                        continue;
                ?>
                    <div class="activity-block">
                        <div style="display:flex;">
                            <div class="col1">
                                <span style="color:#a00000; font-weight: bold;"><?= ($booking['room_name']) ? ($booking['room_name']) : "NO NAME"; ?></span>
                            </div>
                            <div class="col2">
                                <?= str_replace("-",".", $booking['room_date']) ?>
                            </div>
                        </div>

                        <div style="display:flex;">
                            <div class="col1">
                                <?= ($booking['name']) ? ($booking['name']) : ""; ?>
                            </div>
                            <div class="col2">
                                <?= str_replace("-",".", $booking['room_time']) ?>
                            </div>
                        </div>

                        <div style="display:flex;  ">
                            <div class="col1">
                                <?= $booking['phone'] ?>
                            </div>
                            <div class="col2">

                            </div>
                        </div>

                        <div style="margin: 10px -10px; display:flex; border-bottom: 1px solid #eee;"></div>

                        <div class="comment-booking">
                            <?= ($booking['comments']) ? ($booking['comments'])  : ""; ?>
                        </div>

                        <div style="display:flex; direction: rtl;">
                            <form action="" method="post" class="dashboard-form-del">
                                <?php if (check_capability_delete_button()): ?>
                                    <button class="button button-delete" value="<?= $booking['booking_id']; ?>" name="delete_booking" type="submit" ><?= __( 'Delete', 'booking-system' ); ?></button>
                                <?php endif; ?>
                            </form>
                            <a href="<?= admin_url('edit.php'); ?>?post_type=bookings&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button type="button" class="button button-primary button-edit"><?= __( 'Edit', 'booking-system' ); ?></button></a>
                        </div>
                    </div>
                <?php
                endforeach;
            });

        }

} );


/***************** *********************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_all_booking' );
function bkng_dashboard_widget_all_booking() {
    if (check_capability_other_button())
        return;
    wp_add_dashboard_widget( 'bkng_dashboard_widget_all_booking', __( 'All Booking', 'booking-system' ), 'bkng_dashboard_widget_all_booking_handler' );
}

function bkng_dashboard_widget_all_booking_handler() {
    global $all_bookings;
    if (!$all_bookings)
        $all_bookings = get_booking_after_date(current_time('d-m-Y'), current_time('H:i'), 'off', 'on');
    foreach ($all_bookings as $booking):
?>
        <div class="activity-block">

            <div style="display:flex;">
                <div class="col1">
                    <span style="color:#a00000; font-weight: bold;"><?= ($booking['room_name']) ? ($booking['room_name']) : "NO NAME"; ?></span>
                </div>
                <div class="col2">
                    <?= str_replace("-",".", $booking['room_date']) ?>
                </div>
            </div>

            <div style="display:flex;">
                <div class="col1">
                    <?= ($booking['name']) ? ($booking['name']) : ""; ?>
                </div>
                <div class="col2">
                    <?= str_replace("-",".", $booking['room_time']) ?>
                </div>
            </div>

            <div style="display:flex;">
                <div class="col1">
                    <?= $booking['phone'] ?>
                </div>
                <div class="col2">

                </div>
            </div>

            <div style="margin: 10px -10px; display:flex; border-bottom: 1px solid #eee;"></div>

            <div class="comment-booking">
                <?= ($booking['comments']) ? ($booking['comments'])  : ""; ?>
            </div>

            <div style="display:flex; direction: rtl;">
                <form action="" method="post" class="dashboard-form-del">
                    <?php if (check_capability_delete_button()): ?>
                        <button class="button button-delete" value="<?= $booking['booking_id']; ?>" name="delete_booking" type="submit" ><?= __( 'Delete', 'booking-system' ); ?></button>
                    <?php endif; ?>
                </form>
                <a href="<?= admin_url('edit.php'); ?>?post_type=bookings&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button type="button" class="button button-primary button-edit"><?= __( 'Edit', 'booking-system' ); ?></button></a>

            </div>
        </div>
    <?php
    endforeach;
}

/******************** ************************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_need_approve' );
function bkng_dashboard_widget_need_approve() {
    if (check_capability_other_button())
        return;
    wp_add_dashboard_widget( 'bkng_dashboard_widget_need_approve', __( 'Need Approve', 'booking-system' ), 'bkng_dashboard_widget_need_approve_handler' );
}

function bkng_dashboard_widget_need_approve_handler() {
    $need_approve_bookings = get_booking_after_date(current_time('d-m-Y'), current_time('H:i'), 'off', 'off');
    if (is_array($need_approve_bookings))
    foreach ($need_approve_bookings as $booking):
?>
        <div class="activity-block">

            <div style="display:flex;">
                <div class="col1">
                    <span style="color:#a00000; font-weight: bold;"><?= ($booking['room_name']) ? ($booking['room_name']) : "NO NAME"; ?></span>
                </div>
                <div class="col2">
                    <?= str_replace("-",".", $booking['room_date']) ?>
                </div>
            </div>

            <div style="display:flex;">
                <div class="col1">
                    <?= ($booking['name']) ? ($booking['name']) : ""; ?>
                </div>
                <div class="col2">
                    <?= str_replace("-",".", $booking['room_time']) ?>
                </div>
            </div>

            <div style="display:flex;  ">
                <div class="col1">
                    <?= $booking['phone'] ?>
                </div>
                <div class="col2">
                </div>
            </div>

            <div style="margin: 10px -10px; display:flex; border-bottom: 1px solid #eee;"></div>

            <div class="comment-booking">
                <?= ($booking['comments']) ? ($booking['comments'])  : ""; ?>
            </div>

            <div style="display:flex; direction: rtl;">
                <form action="" method="post" class="dashboard-form-approve">
                    <input type="hidden" name="booking_id" value="<?= $booking['booking_id']; ?>" />
                    <button class="button button-approve" name="approve_booking" type="submit"><?= __( 'Approve', 'booking-system' ); ?></button>
                </form>
                <form action="" method="post" class="dashboard-form-del">
                    <?php if (check_capability_delete_button()): ?>
                        <button class="button button-delete" value="<?= $booking['booking_id']; ?>" name="delete_booking" type="submit" ><?= __( 'Delete', 'booking-system' ); ?></button>
                    <?php endif; ?>
                </form>
                <a href="<?= admin_url('edit.php'); ?>?post_type=bookings&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button type="button" class="button button-primary button-edit"><?= __( 'Edit', 'booking-system' ); ?></button></a>
            </div>
        </div>
    <?php
    endforeach;
}

/******************** ************************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_frozen' );
function bkng_dashboard_widget_frozen() {
    if (check_capability_other_button())
        return;
    wp_add_dashboard_widget( 'bkng_dashboard_widget_frozen', __( 'Frozen', 'booking-system' ), 'bkng_dashboard_widget_frozen_handler' );
}

function bkng_dashboard_widget_frozen_handler() {

    $frozen_bookings = get_booking_after_date(current_time('d-m-Y'), current_time('H:i'), 'on');
    if (is_array($frozen_bookings))
    foreach ($frozen_bookings as $booking):
        ?>
        <div class="activity-block">
            <div style="display:flex;">
                <div class="col1">
                    <span style="color:#a00000; font-weight: bold;"><?= ($booking['room_name']) ? ($booking['room_name']) : "NO NAME"; ?></span>
                </div>
                <div class="col2">
                    <?= str_replace("-",".", $booking['room_date']) ?>
                </div>
            </div>

            <div style="display:flex;">
                <div class="col1">
                    <?= ($booking['name']) ? ($booking['name']) : ""; ?>
                </div>
                <div class="col2">
                    <?= str_replace("-",".", $booking['room_time']) ?>
                </div>
            </div>

            <div style="display:flex;  ">
                <div class="col1">
                    <?= $booking['phone'] ?>
                </div>
                <div class="col2">

                </div>
            </div>

            <div style="margin: 10px -10px; display:flex; border-bottom: 1px solid #eee;"></div>

            <div class="comment-booking">
                <?= ($booking['comments']) ? ($booking['comments'])  : ""; ?>
            </div>
            <div style="display:flex; direction: rtl;">
                <form action="" method="post" class="dashboard-form-del">
                    <?php if (check_capability_delete_button()): ?>
                        <button class="button button-delete" value="<?= $booking['booking_id']; ?>" name="delete_booking" type="submit" ><?= __( 'Delete', 'booking-system' ); ?></button>
                    <?php endif; ?>
                </form>
                <a href="<?= admin_url('edit.php'); ?>?post_type=bookings&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button type="button" class="button button-primary button-edit"><?= __( 'Edit', 'booking-system' ); ?></button></a>
            </div>
        </div>
    <?php
    endforeach;
}

/******************** ************************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_newbooking' );
function bkng_dashboard_widget_newbooking() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_newbooking', __( 'New Booking', 'booking-system' ), 'bkng_dashboard_widget_newbooking_handler' );
}

function bkng_dashboard_widget_newbooking_handler() {
    ?>
    <div class="activity-block">
        <a style="float: inherit;" href="<?= admin_url('admin.php?page=booking-calendar'); ?>"><button style=" background: #e6ec2ab5;" class="button button-primary"><?= __('New Booking','booking-system'); ?></button></a>
    </div>
    <?php
}

/******************** AutoRefresh Dashboard *******************/
add_action('admin_head', function (){

    if (get_current_screen()->id === 'dashboard'){
        ?>
        <script>
            var time = new Date().getTime();
            jQuery(document.body).bind("mousemove keypress", function(e) {
                time = new Date().getTime();
            });
            function refresh() {
                if(new Date().getTime() - time >= 2000)
                    window.location.reload(true);
                else
                    setTimeout(refresh, 2000);
            }
            setTimeout(refresh, 1000*60);
        </script>
        <style>
            .dashboard-form-del, .dashboard-form-approve {
                float: right;
                margin: 0 0 0 5px;
            }
        </style>
        <style>
            .col1{
                flex: 75%;
                font-size: 16px;
                margin: 2px 0;
            }
            .col2{
                flex: 25%;
                font-size: 16px;
                margin: 2px 0;
            }
            .comment-booking{
                display: flex;
                font-size: 16px;
                margin: 5px 0;
            }
            .wp-core-ui .button-primary  {
                background: #a5a5a5;
                border-color: black;
                color: black;
                text-decoration: none;
                text-shadow: none;
                padding: 5px 25px;
                font-size: 18px;
                height: auto;
            }
            .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {
                background: #a5a5a540;
                border-color: black;
                color: black;
                text-decoration: none;
                text-shadow: none;
                padding: 5px 25px;
                font-size: 18px;
                height: auto;
            }
            .wp-core-ui .button-delete{
                padding: 5px 25px;
                font-size: 18px;
                height: auto;
                border-color: black;
                background: #d61111c4;
                color: #fff;
                box-shadow: 0 1px 0 #ff3636;
                margin: 0 10px;
            }
            form.dashboard-form-del{
                float: right !important;
                display: contents;
            }
            #dashboard-widgets a  {
                text-decoration: none;
                float: right;
            }

            .wp-core-ui .button-approve {
                background: #e6ec2ab5;
                color: #4a4a4a;
                border-color: #4a4a4a;
                box-shadow: 0 1px 0 #0a7b00b5;
                padding: 5px 25px;
                font-size: 18px;
                height: auto;
            }
            .activity-block{
                padding-bottom: 10px;
                border-bottom: 4px solid #eee;
            }
            .button {
                font-weight: bold !important;
            }
            .activity-block{
                margin-top: 14px;
            }

        </style>
        <?php
    }elseif (get_current_screen()->id === 'edit-bookings'){
        ?><style>li.publish{display: none !important;}</style><?php
    }else{
        ?>
        <style>
            .wp-admin select{
                max-width: none;
            }
            .btn-success{
                padding: 9px 4px;
            }
            .edit-button{
                background: #a5a5a5;
                border-color: black;
                color: black;
                text-decoration: none;
                text-shadow: none;
                padding: 6px 15px;
                font-size: 18px;
            }
            .edit-button:hover{
                background: #a5a5a5;
                border-color: black;
                color: black;

            }

            button.btn-danger.delete-button{
                font-size: 18px;
                padding: 6px 15px;
                border-color: black;
                background: #d61111c4;
                color: white;
                margin: 0 5px;
            }
            button.btn-danger.delete-button:hover{
                border-color: black;
                background: #d61111c4;
                color: white;
            }
            button.btn-primary.save-button {
                  background: #e6ec2ab5;
                  border-color: black;
                  color: black;
                  text-decoration: none;
                  text-shadow: none;
                  padding: 6px 19px;
                  font-size: 18px;
              }
            button.btn-primary.save-button:hover {
                background: #e6ec2ab5;
                border-color: black;
                color: black;
            }
            .fw-option-type-addable-box > .fw-option-boxes.ui-sortable > .fw-option-box > .fw-postbox > .hndle > span{
                padding-right: 45px;
            }
        </style>
        <?php
    }
});

/******************** Hide Admin Menu for manager *******************/
add_action('admin_head', function (){
    $user_meta=get_userdata(get_current_user_id());
    $user_roles=$user_meta->roles;
    if (check_capability_other_button() && get_current_screen()->id == 'edit-bookings'){
        die;
    }
    if (!in_array('manager', $user_roles) && !check_capability_other_button()):
        return true;
    elseif (check_capability_other_button()):
    ?>
        <style>#menu-posts-bookings{display: none;}</style>
    <?php
    endif;
    ?>
    <style>
        #wp-admin-bar-new-content, #adminmenu li:not(#menu-dashboard):not(#toplevel_page_booking-calendar):not(#menu-posts-bookings) {display: none;}
    </style>
    <?php
});