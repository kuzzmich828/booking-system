

var ROOMS_DATES_TIMES = null;

var input_rooms = "select.choose-room";
var table_edit = ".booking-table-edit";

var container_rooms = ".step-2";
var container_time = ".step-3";
var container_edit = ".step-4";

jQuery( document ).ready(function() {


    /********* Select a Day *********/
    jQuery(document).on("click", ".cell-day, .fc-today", function (event) {

        spinnerShow();

        var sel_date = jQuery(this).attr("data-date-attr");
        /******* AJAX ******/
        jQuery.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {action:'get_booking_rooms_by_date', date:sel_date},
            success: function( data ) {
                ROOMS_DATES_TIMES = JSON.parse(data);
                fillRooms(ROOMS_DATES_TIMES);
                spinnerHide();
            }
        });

        jQuery(container_rooms).fadeIn(300);
        jQuery(input_rooms).val(0);
        jQuery(container_time).hide();

    });

    /********* Select a Day *********/
    jQuery(document).on("click", ".cell-day, .fc-today", function (event) {

        var days = jQuery("#calendar").find(".cell-day, .fc-today");
        jQuery( days ).each(function( index ) {
            jQuery(days[index]).removeClass('selected-day');
        });
        jQuery(this).toggleClass("selected-day");

    });

    /********* Select a Time *********/
    jQuery(document).on("click", ".cell-time", function (event) {

        var days = jQuery("#calendar-time").find(".cell-time");
        jQuery( days ).each(function( index ) {
            jQuery(days[index]).removeClass('selected-day');
        });
        jQuery(this).toggleClass("selected-day");

    });

    /********* Select a Time *********/
    jQuery(document).on("click", ".cell-time", function (event) {

        var booking_id = jQuery(this).attr('data-booking-id');

        if (booking_id){
            spinnerShow();

            var sel_date = jQuery(this).attr("data-date-attr");
            /******* AJAX ******/
            jQuery.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {action:'get_booking', booking_id:booking_id},
                success: function( data ) {
                    fillBooking(JSON.parse(data));
                    spinnerHide();
                }
            });

            jQuery(container_edit).fadeIn(300);

        }else{

        }

    });


    /********* Select a Room *********/
    jQuery(input_rooms).on("change", function (event) {
        spinnerShow();

        fillTimes(ROOMS_DATES_TIMES, jQuery(this).val());
        fillRezerved(jQuery(this).val(), ROOMS_DATES_TIMES);

        jQuery(container_time).fadeIn(300);

        spinnerHide();
    });
    
    /********* Select a Room *********/
    jQuery(input_rooms).on("change", function (event) {
        spinnerShow();

        fillTimes(ROOMS_DATES_TIMES, jQuery(this).val());
        fillRezerved(jQuery(this).val(), ROOMS_DATES_TIMES);

        jQuery(container_time).fadeIn(300);

        spinnerHide();
    });

    /********* Button EDIT *********/
    jQuery(table_edit+" .edit-button").on("click", function (event) {

        jQuery(table_edit + " input, " + table_edit + " select, " + table_edit + " textarea").prop("disabled", false);
        jQuery(this).hide();
        jQuery(table_edit + " .save-button").show();

    });

    /********* Button DELETE *********/
    jQuery(table_edit + " .delete-button").on("click", function (event) {

        if (confirm("Do you want to delete booking?")){

            jQuery(container_rooms+", "+container_time+", "+container_edit).hide();

        }

    });
    
});


function spinnerShow() {
    jQuery('div.loading').show();
}

function fillBooking(data) {
    jQuery("#booking_id").val(data['id']);
    jQuery("#phone_booking").val(data['phone']);
    jQuery("#email_booking").val(data['email']);
    jQuery("#name_booking").val(data['name']);
    jQuery("#notes_booking").val(data['notes']);
    jQuery("#discount_booking").val(data['discount']);
    jQuery(table_edit + " input, " + table_edit + " select, " + table_edit + " textarea").prop("disabled", true);
}

function spinnerHide() {
    jQuery('div.loading').hide();
}

function fillRooms(data) {
    var options = '<option selected disabled>Choose</option>';
    var exclude = [];
    jQuery(data).each(function (index) {
        if (exclude.indexOf(data[index]['room_id']) < 0) {
            options += '<option value = "' + data[index]['room_id'] + '">' + data[index]['room_name'] + ' - ' + countRooms(data, data[index]['room_id']) + '</option>';
            exclude.push(data[index]['room_id']);
        }
    });
    jQuery(input_rooms).html(options);
}

function fillRezerved(room_id, data) {
    jQuery(data).each(function (index) {
        if (data[index]['room_id'] == room_id){

            jQuery('#calendar-time .cell-time[data-time="'+data[index]['room_time']+'"]').addClass('reserved').attr('data-booking-id', data[index]['id']);


        }
    });
}

function countRooms(data, room_id) {
    var result = 0;
    jQuery(data).each(function (index) {
        if (data[index]['room_id'] == room_id)
            result++;
    });
    return result;
}

function fillTimes(data, room_id) {
    var rows = '';
    jQuery(data).each(function (index) {
        if (data[index]['room_id'] == room_id){

            jQuery(data[index]['room_times']).each(function (time_index) {

                if (time_index == 0){
                    rows += '<div class="fc-row">';
                }else if (time_index >= data[index]['room_times'].length) {
                    rows += '</div>';
                }else if (time_index % 4 == 0) {
                    rows += '</div><div class="fc-row">';
                }
                    // cells.push('<div class="cell-time" data-time="' + data[index]['room_times'][time_index] + '"><span class="fc-date">' + data[index]['room_times'][time_index] + '</span></div>');
                    rows += '<div class="cell-time" data-time="' + data[index]['room_times'][time_index] + '"><span class="fc-date">' + data[index]['room_times'][time_index] + '</span></div>';



            });

            jQuery('.calendar-time-body').html(rows);

            return false;
        }
    });
}