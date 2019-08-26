
<div class="wrap">
    <div class="row">
        <div class="col-sm-12">
            <span class="alert-calendar"><?= __('Please, chese new date & time','booking-system'); ?></span>
        </div>
    </div>
    <h1><?= __('Booking Calendar'); ?></h1>
    <div class="row wrap-calendar-admin">

        <div class="col-sm-4">
                <div class="custom-calendar-wrap">
                    <div id="custom-inner" class="custom-inner">
                        <div class="custom-header clearfix">
                            <nav>
                                <span id="custom-prev" class="custom-prev"></span>
                                <span id="custom-next" class="custom-next"></span>
                            </nav>
                            <h2 id="custom-month" class="custom-month"></h2>
                            <h3 id="custom-year" class="custom-year"></h3>
                        </div>
                        <div id="calendar" class="fc-calendar-container"></div>
                    </div>
                </div>
        </div>

        <div class="col-sm-4">

            <div class="step-2">
                <h4><?= __('Choose a room:','booking-system'); ?></h4>
                <select class="form-control choose-room">
                    <option selected="selected" disabled value="0">Choose a room</option>
                    <?php
                        $rooms = bkng_get_booking_rooms();
                        foreach ($rooms as $room):
                    ?>
                        <option selected="selected" value="<?= $room->ID; ?>"><?= $room->post_title; ?></option>
                    <?php
                        endforeach;
                    ?>

                </select>
            </div>


            <div class="step-3">
                <div class="custom-calendar-wrap">
                    <div id="custom-inner" class="custom-inner">
                        <div class="custom-header clearfix">
                            <h2 id="custom-month" class="custom-month">Choose time</h2>
                        </div>
                        <div id="calendar-time" class="fc-calendar-container time-calendar">
                            <div class="fc-calendar fc-five-rows">
                                <div class="fc-body calendar-time-body">
                                    <div class="fc-row">
                                        <div class="cell-time" data-date-attr="4/2/2019"><span class="fc-date">4:30</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-sm-4">

            <div class="step-4">
                <h4><?= __('Booking details:','booking-system'); ?></h4>

                <form action="" method="post" class="form-booking" id="form-booking">
                    <table class="table table-striped w-auto booking-table-edit">
                    <tbody>
                        <tr>
                            <td><label><?= __('Name','booking-system'); ?></label></td>
                            <td>
                                <input name="bkng_action" type="hidden" value="save_booking" class="form-control" />
                                <input name="room_id" id="room_id"    type="hidden" value="" class="form-control" />
                                <input name="booking_id" id="booking_id"    type="hidden" value="" class="form-control" />
                                <input name="room_time"  id="room_time"     type="hidden" value="" class="form-control" />
                                <input name="room_date"  id="room_date"     type="hidden" value="" class="form-control" />
                                <input id="name_booking" name="name_booking" placeholder="<?= __('Name...','booking-system'); ?>" type="text" value="" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Phone','booking-system'); ?></label></td>
                            <td>
                                <input name="phone_booking" id="phone_booking"  placeholder="<?= __('Phone...','booking-system'); ?>" type="text" value="" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('E-mail','booking-system'); ?></label></td>
                            <td>
                                <input name="email_booking" id="email_booking" placeholder="<?= __('Email...','booking-system'); ?>" type="email" value="" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Price & Quantity','booking-system'); ?></label></td>
                            <td>
                                <select name="price_booking" id="price_booking"  class="form-control">
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Discount','booking-system'); ?></label></td>
                            <td>
                                <input name="discount_booking" id="discount_booking"  placeholder="<?= __('Discount...','booking-system'); ?>" type="number" min="0" max="100" value="" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Notes','booking-system'); ?></label></td>
                            <td>
                                <textarea name="notes_booking" id="notes_booking" placeholder="<?= __('Your comments...','booking-system'); ?>" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Approve','booking-system'); ?></label></td>
                            <td>
                                <input name="approve_booking" id="approve_booking" type="checkbox" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Frozen','booking-system'); ?></label></td>
                            <td>
                                <input name="frozen_booking" id="frozen_booking" type="checkbox" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-success change-date-button" data-room-id="" type="button"><?= __('Change date/time/room','booking-system'); ?></button>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-success edit-button " type="button"><?= __('Edit','booking-system'); ?></button>
                                <button name="save_booking" style="display:none;" class="btn btn-primary save-button" type="submit"><?= __('Save','booking-system'); ?></button>
                            </td>
                            <td>
                                <?php if (check_capability_delete_button()): ?>
                                    <button id="delete_booking" name="delete_booking" value="" class="btn btn-danger delete-button" type="submit"><?= __('Delete','booking-system'); ?></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>

                <a class="href-new-booking" style="display: none;" href="<?= admin_url('post-new.php'); ?>?post_type=bookings"><button class="button button-primary"><?= __('New Booking'); ?></button></a>

            </div>
        </div>


    </div>
</div>

<script>

    var date_count =  (<?= get_booking_count_by_date(); ?>);

    jQuery(document).ready(function(){
        updateDateCount();
    });

    function updateDateCount() {
        jQuery(date_count).each(function (index) {
            jQuery(".cell-day[data-date-attr='" + date_count[index]['date'] + "'] .fc-total-booking").html(date_count[index]['count']);
        });
    }

</script>


<div class="loading"><img src="<?= plugin_dir_url(__DIR__); ?>/calendar/img/spinner.svg"></div>

<?php if (isset($_GET['edit_booking']) && $_GET['edit_booking']): ?>
    <script>
        BookingInfoAjax(<?=$_GET['edit_booking']; ?>, true);
    </script>
<?php else: ?>
    <script>
        init_calendar(<?= date('m'); ?>);
    </script>
<?php endif; ?>






