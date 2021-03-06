<div class="wrap">
    <div class="row">
        <div class="col-sm-12">
            <span class="alert-calendar"><?= __('Please, chese new date & time','booking-system'); ?></span>
        </div>
    </div>
    <h1><?= __('Booking Calendar','booking-system'); ?></h1>
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
                <div class="custom-calendar-wrap">
                    <div class="custom-header clearfix">
                        <h2 id="custom-month" class="custom-month"><?= __('Choose a room:','booking-system'); ?></h2>
                    </div>
                    <select class="form-control choose-room">
                        <option selected="selected" disabled value="0"><?= __('Choose a room:','booking-system'); ?></option>
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
            </div>


            <div class="step-3">
                <div class="custom-calendar-wrap">
                    <div id="custom-inner" class="custom-inner">

                        <div class="custom-header clearfix">
                            <h2 id="custom-month" class="custom-month"><?= __('Choose time','booking-system'); ?></h2>
                        </div>
                        <div id="calendar-time" class="fc-calendar-container time-calendar">
                            <div class="fc-calendar fc-five-rows">
                                <div class="fc-body calendar-time-body">
                                    <div class="fc-row">
                                        <div class="cell-time" data-date-attr=""><span class="fc-date"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="custom-time-wrap">
                    <div style="padding: 10px 0;">
                        <button class="btn btn-success" id="custom-time-button" type="button" style="display: inline-block;"><?= __('Custom Time', 'booking-system'); ?></button>
                    </div>
                    <div style="display: none;" id="custom-time-table">
                        <p><?= __('Set custom time', 'booking-system'); ?></p>
                        <span style="direction: rtl;margin-right: 10px;margin-left: 25px;">  דקות  </span> <span style="direction: rtl;">  שעות  </span>   <br>
                        <input id="custom-minute" type="number" min="0" max="59" value="00" />:<input type="number" min="0" max="23"  id="custom-hour" value="00" />
                    </div>
                </div>
            </div>

        </div>


        <div class="col-sm-4">

            <div class="step-4">
                <div class="custom-calendar-wrap">

                    <div class="custom-header clearfix">
                        <h2 id="custom-month" class="custom-month"><?= __('Booking details:','booking-system'); ?></h2>
                    </div>

                    <form action="" method="post" class="form-booking" id="form-booking">
                        <table style="background:#f6f6f6" class="table  w-auto booking-table-edit">
                            <tbody>
                            <tr>
                                <td colspan="2">
                                    <input name="bkng_action" type="hidden" value="save_booking" class="form-control" />
                                    <input name="room_id" id="room_id"    type="hidden" value="" class="form-control" />
                                    <input name="booking_id" id="booking_id"    type="hidden" value="" class="form-control" />
                                    <input name="room_time"  id="room_time"     type="hidden" value="" class="form-control" />
                                    <input name="room_date"  id="room_date"     type="hidden" value="" class="form-control" />
                                    <input id="name_booking" name="name_booking" placeholder="<?= __('Name...','booking-system'); ?>" type="text" value="" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input name="phone_booking" autocomplete="on" id="phone_booking"  placeholder="<?= __('Phone...','booking-system'); ?>" type="text" value="" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input name="email_booking" id="email_booking" placeholder="<?= __('Email...','booking-system'); ?>" type="email" value="" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <select name="price_booking" id="price_booking"  class="form-control">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input name="discount_booking" id="discount_booking"  placeholder="<?= __('Discount...','booking-system'); ?>" type="number" min="0" max="100" value="" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea name="notes_booking" id="notes_booking" placeholder="<?= __('Your comments...','booking-system'); ?>" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="approve_booking" id="approve_booking" type="checkbox" class="form-control" /> <label><?= __('Approve','booking-system'); ?></label>
                                    &nbsp;&nbsp;
                                    <input name="frozen_booking" id="frozen_booking" type="checkbox" class="form-control" /> <label><?= __('Frozen','booking-system'); ?></label>
                                    &nbsp;
                                    <input name="canceled_booking" id="canceled_booking" type="checkbox" class="form-control" /> <label><?= __('Canceled','booking-system'); ?></label>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <button class="btn btn-success edit-button " type="button"><?= __('Edit','booking-system'); ?></button>
                                    <button name="save_booking" style="display:none;" class="btn btn-primary save-button" type="submit"><?= __('Save','booking-system'); ?></button>
                                    <?php if (check_capability_delete_button()): ?>
                                        <button id="delete_booking" name="delete_booking" value="" class="btn btn-danger delete-button" type="submit"><?= __('Delete','booking-system'); ?></button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-success change-date-button" data-room-id="" type="button"><?= __('Change date/time/room','booking-system'); ?></button>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
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
        jQuery(document).ready(function(){ BookingInfoAjax(<?=$_GET['edit_booking']; ?>, true); });
    </script>
<?php else: ?>
    <script>
        jQuery(document).ready(function(){ init_calendar(<?= date('m'); ?>); });
    </script>
<?php endif; ?>