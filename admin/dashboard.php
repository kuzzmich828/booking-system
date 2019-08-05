<?php

/********** Write widget for every room ************/

add_action( 'wp_dashboard_setup', function () {

    $posts = get_posts([
        'post_type'=>'room',
        'numberposts'=> -1,
        'post_status'=> 'publish'
    ]);

    if ($posts)
        foreach ($posts as $post) {

            wp_add_dashboard_widget('bkng_dashboard_widget_room_' . $post->ID, __( 'Room', 'bkng' ).": ".$post->post_title, function () use ($post) {
                $all_bookings = get_booking_after_date(current_time('d-m-Y'), current_time('H:i'), 'off', 'on');
                foreach ($all_bookings as $booking):
                    if ($booking['room_id'] != $post->ID)
                        continue;
                    ?>
                    <div class="activity-block">
                        <h3 style="font-weight: bold;"> <?= ($booking['room_name']) ? ($booking['room_name']) : "NO NAME"; ?>  </h3>

                        <ul>
                            <li>
                                <i><?= $booking['room_date'] . ", " .$booking['room_time']; ?></i>
                            </li>
                        </ul>

                        <div style="color: #000e14;">
                            <p>
                                <?= ($booking['name']) ? ($booking['name']) ." |" : ""; ?>
                                <?= ($booking['phone']) ? ($booking['phone']) ." |" : ""; ?>
                                <?= ($booking['comments']) ? ($booking['comments']) ." |" : ""; ?>
                                <?= ($booking['amount_price']) ? ($booking['amount_price']) ." |" : ""; ?>
                            </p>
                        </div>

                        <a href="<?= admin_url('edit.php'); ?>?post_type=bookings&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button type="button" class="button button-primary">Edit</button></a>
                        <form action="" method="post" class="dashboard-form-del">
                            <input type="hidden" name="booking_id" value="<?= $booking['booking_id']; ?>" />
                            <button class="button button-delete" name="delete_booking" type="submit" >Delete</button>
                        </form>

                    </div>
                <?php
                endforeach;
            });

        }

} );


/***************** *********************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_all_booking' );
function bkng_dashboard_widget_all_booking() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_all_booking', __( 'All Booking', 'bkng' ), 'bkng_dashboard_widget_all_booking_handler' );
}

function bkng_dashboard_widget_all_booking_handler() {

    $all_bookings = get_booking_after_date(current_time('d-m-Y'), current_time('H:i'), 'off', 'on');
    foreach ($all_bookings as $booking):
        ?>
        <div class="activity-block">
            <h3 style="font-weight: bold;"> <?= ($booking['room_name']) ? ($booking['room_name']) : "NO NAME"; ?> </h3>

            <ul>
                <li>
                    <i><?= $booking['room_date'] . ", " .$booking['room_time']; ?></i>
                </li>
            </ul>

            <div style="color: #000e14;">
                <p>
                    <?= ($booking['name']) ? ($booking['name']) ." |" : ""; ?>
                    <?= ($booking['phone']) ? ($booking['phone']) ." |" : ""; ?>
                    <?= ($booking['comments']) ? ($booking['comments']) ." |" : ""; ?>
                    <?= ($booking['amount_price']) ? ($booking['amount_price']) ." |" : ""; ?>
                </p>
            </div>

            <a href="<?= admin_url('edit.php'); ?>?post_type=bookings&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button type="button" class="button button-primary">Edit</button></a>
            <form action="" method="post" class="dashboard-form-del">
                <input type="hidden" name="booking_id" value="<?= $booking['booking_id']; ?>" />
                <button class="button button-delete" name="delete_booking" type="submit" >Delete</button>
            </form>

        </div>
    <?php
    endforeach;
}

/******************** ************************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_need_approve' );
function bkng_dashboard_widget_need_approve() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_need_approve', __( 'Need Approve', 'bkng' ), 'bkng_dashboard_widget_need_approve_handler' );
}

function bkng_dashboard_widget_need_approve_handler() {
    $need_approve_bookings = get_booking_after_date(current_time('d-m-Y'), current_time('H:i'), null, 'off');
    foreach ($need_approve_bookings as $booking):
        ?>
        <div class="activity-block">
            <h3 style="font-weight: bold;"> <?= ($booking['room_name']) ? ($booking['room_name']) : "NO NAME"; ?> </h3>

            <ul>
                <li>
                    <i><?= $booking['room_date'] . ", " .$booking['room_time']; ?></i>
                </li>
            </ul>

            <div style="color: #000e14;">
                <p>
                    <?= ($booking['name']) ? ($booking['name']) ." |" : ""; ?>
                    <?= ($booking['phone']) ? ($booking['phone']) ." |" : ""; ?>
                    <?= ($booking['comments']) ? ($booking['comments']) ." |" : ""; ?>
                    <?= ($booking['amount_price']) ? ($booking['amount_price']) ." |" : ""; ?>
                </p>
            </div>

            <form action="" method="post" class="dashboard-form-approve">
                <input type="hidden" name="booking_id" value="<?= $booking['booking_id']; ?>" />
                <button class="button button-approve" name="approve_booking" type="submit">Approve</button>
            </form>
            <a href="<?= admin_url('edit.php'); ?>?post_type=bookings&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button type="button" class="button button-primary">Edit</button></a>
            <form action="" method="post" class="dashboard-form-del">
                <input type="hidden" name="booking_id" value="<?= $booking['booking_id']; ?>" />
                <button class="button button-delete" name="delete_booking" type="submit" >Delete</button>
            </form>

        </div>


    <?php
    endforeach;

}


/******************** ************************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_frozen' );
function bkng_dashboard_widget_frozen() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_frozen', __( 'Frozen', 'bkng' ), 'bkng_dashboard_widget_frozen_handler' );
}

function bkng_dashboard_widget_frozen_handler() {

    $frozen_bookings = get_booking_after_date(current_time('d-m-Y'), current_time('H:i'), 'on');
    foreach ($frozen_bookings as $booking):
        ?>
        <div class="activity-block">
            <h3 style="font-weight: bold;"> <?= ($booking['room_name']) ? ($booking['room_name']) : "NO NAME"; ?> </h3>

            <ul>
                <li>
                    <i><?= $booking['room_date'] . ", " .$booking['room_time']; ?></i>
                </li>
            </ul>

            <div style="color: #000e14;">
                <p>
                    <?= ($booking['name']) ? ($booking['name']) ." |" : ""; ?>
                    <?= ($booking['phone']) ? ($booking['phone']) ." |" : ""; ?>
                    <?= ($booking['comments']) ? ($booking['comments']) ." |" : ""; ?>
                    <?= ($booking['amount_price']) ? ($booking['amount_price']) ." |" : ""; ?>
                </p>
            </div>

            <input type="hidden" name="booking_id" value="<?= $booking['booking_id']; ?>" />
            <a href="<?= admin_url('edit.php'); ?>?post_type=bookings&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button type="button" class="button button-primary">Edit</button></a>
            <form action="" method="post" class="dashboard-form-del">
                <button class="button button-delete" name="delete_booking" type="submit" >Delete</button>
            </form>

        </div>
    <?php
    endforeach;
}

/******************** ************************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_newbooking' );
function bkng_dashboard_widget_newbooking() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_newbooking', __( 'New Booking', 'bkng' ), 'bkng_dashboard_widget_newbooking_handler' );
}

function bkng_dashboard_widget_newbooking_handler() {
    ?>
    <div class="activity-block">
        <p>
            <a href="<?= admin_url('admin.php?page=booking-calendar'); ?>"><button class="button button-primary"><?= __('New Booking','bkng'); ?></button></a>
        </p>
    </div>
    <?php
}


/******************** AutoRefresh Dashboard *******************/
add_action('admin_footer', function (){


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
                float: left;
                margin: 0 10px;
            }
        </style>
        <?php
    }
});


/******************** Hide Admin Menu for manager *******************/
add_action('admin_head', function (){
    $user_meta=get_userdata(get_current_user_id());
    $user_roles=$user_meta->roles;
    if (!in_array('manager', $user_roles))
        return true;
    ?>
    <style>
        #adminmenu li:not(#menu-dashboard):not(#toplevel_page_booking-calendar)
        {
            display: none;
        }
    </style>
    <?php
});