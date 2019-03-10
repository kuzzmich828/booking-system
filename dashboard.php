<?php
/***************** *********************/
add_action( 'wp_dashboard_setup', 'bkng_dashboard_widget_all_booking' );
function bkng_dashboard_widget_all_booking() {
    wp_add_dashboard_widget( 'bkng_dashboard_widget_all_booking', __( 'All Booking', 'bkng' ), 'bkng_dashboard_widget_all_booking_handler' );
}

function bkng_dashboard_widget_all_booking_handler() {

    $all_bookings = get_booking_after_date(date('d-m-Y'), date('H:i'));
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


            <p>
                <a href="<?= admin_url('edit.php'); ?>?post_type=booking&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button class="button button-primary">Edit</button></a>
                <button class="button button-delete">Delete</button>
            </p>
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
    $need_approve_bookings = get_booking_after_date(date('d-m-Y'), date('H:i'), null, 'off');
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


            <p>
                <form action="" method="post" class="dashboard-form">
                    <input type="hidden" name="booking_id" value="<?= $booking['booking_id']; ?>" />
                    <button class="button button-approve" name="approve_booking" type="submit">Approve</button>
                    <a href="<?= admin_url('edit.php'); ?>?post_type=booking&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button class="button button-primary">Edit</button></a>
                    <button class="button button-delete" name="delete_booking" type="submit" >Delete</button>
                </form>
            </p>
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

    $frozen_bookings = get_booking_after_date(date('d-m-Y'), date('H:i'), 'on');
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


        <p>
            <a href="<?= admin_url('edit.php'); ?>?post_type=booking&page=booking-calendar&edit_booking=<?= $booking['booking_id']; ?>"><button class="button button-primary">Edit</button></a>
            <button class="button button-delete">Delete</button>
        </p>
    </div>
    <?php
    endforeach;
}