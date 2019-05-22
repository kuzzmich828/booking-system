
var calendar_month = null;
var ROOMS_DATES_TIMES = null;

var input_rooms = "select.choose-room";
var table_edit = ".booking-table-edit";

var container_rooms = ".step-2";
var container_time = ".step-3";
var container_edit = ".step-4";
var SELECT_CELL = "selected-day";
var button_save = ".save-button";
var button_edit = ".edit-button";
var button_delete = ".delete-button";
var button_new_booking = ".href-new-booking";

jQuery( document ).ready(function() {


    jQuery(document).on("click", button_new_booking, function (event) {

        event.preventDefault();

        var data = [];
        data['room_id'] = jQuery('.choose-room').val();
        data['booking_id'] = '';
        data['room_time'] = jQuery('.cell-time.selected-day').attr('data-time');
        data['room_date'] = jQuery('.cell-day.selected-day').attr('data-date-attr');
        data['phone'] = '';
        data['email'] = '';
        data['name'] = '';
        data['comments'] = '';
        data['amount_price'] = 0;
        data['quantity'] = 0;
        data['frozen'] = 'off';
        data['approve'] = 'off';

        $("#room_id").val(data['room_id']);

        fillBooking(data, true);

        jQuery(this).hide();
        jQuery(button_save).show();
        jQuery(button_edit).hide();
        jQuery(container_edit).show();
        jQuery(table_edit).fadeIn(300);

    });


    jQuery(document).submit( button_save, function (event) {


        if (!jQuery('#frozen_booking').prop('checked')){
            if (jQuery('#name_booking').val() == ''){
                event.preventDefault();
                alert("Field 'Name' is empty");
            }else if (jQuery('#email_booking').val() == ''){
                event.preventDefault();
                alert("Field 'Email' is empty");
            }else if (jQuery('#phone_booking').val() == ''){
                event.preventDefault();
                alert("Field 'Phone' is empty");
            }
        }
    });


    jQuery(document).on("click", "div.cell-day.past-date", function (event) {
        event.preventDefault();
    });

    /********* Select a Day *********/
    jQuery(document).on("click", ".cell-day, .fc-today", function (event) {

        if (jQuery(this).attr('data-date-attr') == '')
            return;

        if (jQuery(this).attr('class').indexOf('past-date') > -1){
            return;
        }

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

        if (jQuery(this).attr('data-date-attr') == '')
            return;

        if (jQuery(this).attr('class').indexOf('past-date') > -1){
            return;
        }
        jQuery(table_edit).hide();
        showNewBooking();

        var days = jQuery("#calendar").find(".cell-day, .fc-today");
        jQuery( days ).each(function( index ) {
            jQuery(days[index]).removeClass(SELECT_CELL);
        });
        jQuery(this).toggleClass(SELECT_CELL);

    });

    /********* Select a Time *********/
    jQuery(document).on("click", ".cell-time", function (event) {

        var days = jQuery("#calendar-time").find(".cell-time");
        jQuery( days ).each(function( index ) {
            jQuery(days[index]).removeClass('selected-day');
        });
        jQuery(this).toggleClass("selected-day");

        jQuery(button_delete).show();
        jQuery(button_edit).show();
        jQuery(button_save).hide();

    });

    /********* Select a Time *********/
    jQuery(document).on("click", ".cell-time", function (event) {

        var booking_id = jQuery(this).attr('data-booking-id');

        jQuery("#booking_id").val(booking_id);

        hideNewBooking();

        if (booking_id){
            spinnerShow();
            // var sel_date = jQuery(this).attr("data-date-attr");
            BookingInfoAjax(booking_id);
            jQuery(table_edit).show();
        } else {
            jQuery(table_edit).hide();
            showNewBooking();
        }


        updateUrlBookingID();
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
    jQuery(table_edit+" "+button_edit).on("click", function (event) {

        updateUrlBookingID();

        jQuery(table_edit + " input, " + table_edit + " select, " + table_edit + " textarea").prop("disabled", false);
        jQuery(this).hide();
        jQuery(table_edit + " .save-button").show();

    });

    /********* Button DELETE *********/
    jQuery(table_edit+" "+button_delete).on("click", function (event) {

        if (confirm(bkng_messages.message_confirm_before_delete_booking)){
            jQuery(container_rooms+", "+container_time+", "+container_edit).hide();
        }

    });
    
});

function showNewBooking() {

    var date = jQuery('.cell-day.selected-day').attr('data-date-attr');
    var time = jQuery('.cell-time.selected-day').attr('data-time');
    var room_id = jQuery('.choose-room').val();
    // jQuery(button_new_booking).attr('href',
    //     '/wp-admin/post-new.php?post_type=bookings&room_id='+room_id+'&time='+time+'&date='+date);
    jQuery(container_edit).fadeIn(300);
    jQuery(button_new_booking).fadeIn(300);
}

function hideNewBooking() {
    jQuery(button_new_booking).hide();
}

function updateUrlBookingID() {

    var booking_id = jQuery("#booking_id").val();

    if (booking_id) {
        if (window.location.href.indexOf("edit_booking") < 0)
            window.history.pushState("", "", window.location.href + '&edit_booking=' + jQuery("#booking_id").val());
        else
            window.history.pushState("", "", window.location.href.replace(/edit_booking=[0-9]{0,6}/gi, 'edit_booking=' + jQuery("#booking_id").val()));
    } else {
        window.history.pushState("", "", window.location.href.replace(/\&edit_booking=[0-9]{0,6}/gi, ''));
    }

}

function BookingInfoAjax(booking_id, onload = false) {

    /******* AJAX ******/
    jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {action:'get_booking', booking_id:booking_id},
        success: function( data ) {
            var booking = JSON.parse(data);
            if (booking) {
                fillBooking(booking);

                if (onload) {
                    var sel_date = jQuery(".cell-day.selected-day").attr("data-date-attr");
                    var room_id = booking['room_id'];

                    /******* AJAX ******/
                    jQuery.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        type: 'POST',
                        data: {action: 'get_booking_rooms_by_date', date: sel_date},
                        success: function (data) {
                            ROOMS_DATES_TIMES = JSON.parse(data);
                            fillRooms(ROOMS_DATES_TIMES);
                            jQuery('.choose-room').val(room_id);
                            jQuery('.choose-room').change();
                            jQuery('.cell-time[data-time="'+booking['room_time']+'"]').toggleClass(SELECT_CELL);
                        }
                    });
                }
            } else {
                jQuery(container_edit).hide();
                init_calendar('m');
            }
            spinnerHide();
        }
    });
    jQuery(container_edit).fadeIn(300);
}

function AutoFillDateTimeBooking(date){
    init_calendar(date.split('-')[1]);
    var days = jQuery("#calendar").find(".cell-day, .fc-today");
    jQuery( days ).each(function( index ) {
        jQuery(days[index]).removeClass(SELECT_CELL);
    });
    jQuery("#calendar").find(".cell-day[data-date-attr='"+date+"']").toggleClass(SELECT_CELL);

}

function spinnerShow() {
    jQuery('div.loading').show();
}

function fillBooking(data, clear = false) {

    jQuery("#booking_id").val(data['booking_id']);
    jQuery("#room_time").val(data['room_time']);
    jQuery("#room_date").val(data['room_date']);
    jQuery("#phone_booking").val(data['phone']);
    jQuery("#email_booking").val(data['email']);
    jQuery("#name_booking").val(data['name']);
    jQuery("#notes_booking").val(data['comments']);
    jQuery("#price_booking").html(
        '<option selected value="'+data['amount_price']+'">'+data['quantity'] + ' - ' +data['amount_price']+'</option>'
    );

    if (data['frozen'] == 'on')
        jQuery("#frozen_booking").prop("checked", true);
    else
        jQuery("#frozen_booking").prop("checked", false);

    if (data['approve'] == 'on')
        jQuery("#approve_booking").prop("checked", true);
    else
        jQuery("#approve_booking").prop("checked", false);

    var amount_price = data['amount_price'];

    /******* Fill Prices ******/
    jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {action:'get_room_attributes', id: data['room_id'] },
        success: function( data ) {
            var response = JSON.parse(data);
            var prices = response['prices'];
            /********* Fill Input Price & Quantity ******/
            var options = '';
            jQuery( prices ).each(function( index ) {
                var selected = '';
                if (amount_price == prices[index]['price']) {
                    selected = 'selected';
                }
                options += '<option '+selected+' value = "' + prices[index]['price'] + '">' + prices[index]['quantity'] + ' - ' + prices[index]['price'] + '</option>';
            });
            jQuery("#price_booking").html(options);
            // console.log(response['times'], response['room_id'] );
            // fillTimes(response['times'], response['room_id']);

        }
    });

    if (data['frozen'] == 'on'){
        jQuery("#frozen_booking").prop('checked', true);
    }else{
        jQuery("#frozen_booking").prop('checked', false);
    }

    if (data['discount'] != null)
        jQuery("#discount_booking").val(data['discount']);
    else
        jQuery("#discount_booking").val('0');

    if (!clear) {
        
        jQuery(table_edit + " input, " + table_edit + " select, " + table_edit + " textarea").prop("disabled", true);
        AutoFillDateTimeBooking(data['room_date']);
        jQuery(container_rooms).show();
        jQuery(container_time).show();

    } else {
        jQuery(table_edit + " input, " + table_edit + " select, " + table_edit + " textarea").prop("disabled", false);
    }
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

    // jQuery(all_rooms).each(function (index) {
    //     console.log(exclude);
    //     if (exclude.includes(all_rooms[index]['room_id'].toString()) === false){
    //         options += '<option value = "' + all_rooms[index]['room_id'] + '">' + all_rooms[index]['room_name'] + ' - 0' + '</option>';
    //     }
    // });

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
        if (data[index]['id'] != null && data[index]['room_id'] == room_id)
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

function init_calendar(set_month) {

        var transEndEventNames = {
                'WebkitTransition' : 'webkitTransitionEnd',
                'MozTransition' : 'transitionend',
                'OTransition' : 'oTransitionEnd',
                'msTransition' : 'MSTransitionEnd',
                'transition' : 'transitionend'
            },
            transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
            $wrapper = $( '#custom-inner' ),
            $calendar = $( '#calendar' ),
            cal = $calendar.calendario( {
                onDayClick : function( $el, $contentEl, dateProperties ) {
                    console.log( dateProperties);
                    if( $contentEl.length > 0 ) {
                        showEvents( $contentEl, dateProperties );
                    }
                },
                caldata : codropsEvents,
                displayWeekAbbr : true,
                month : set_month

            } ),
            $month = $( '#custom-month' ).html( cal.getMonthName() ),
            $year = $( '#custom-year' ).html( cal.getYear() );


        $( '#custom-next' ).on( 'click', function() {
            cal.gotoNextMonth( updateMonthYear );
        } );

        $( '#custom-prev' ).on( 'click', function() {
            cal.gotoPreviousMonth( updateMonthYear );
        } );

        function updateMonthYear() {
            $month.html( cal.getMonthName() );
            $year.html( cal.getYear() );
        }
        // just an example..
        function showEvents( $contentEl, dateProperties ) {

            hideEvents();
            var $events = $( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Events for ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>' ),
                $close = $( '<span class="custom-content-close"></span>' ).on( 'click', hideEvents );
            $events.append( $contentEl.html() , $close ).insertAfter( $wrapper );
            setTimeout( function() {
                $events.css( 'top', '0%' );
            }, 25 );
        }
        function hideEvents() {
            var $events = $( '#custom-content-reveal' );
            if( $events.length > 0 ) {
                $events.css( 'top', '100%' );
                Modernizr.csstransitions ? $events.on( transEndEventName, function() { $( this ).remove(); } ) : $events.remove();
            }
        }
 
}