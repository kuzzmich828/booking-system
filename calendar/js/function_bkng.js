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

var is_change_datetime = false;
var is_edited = true;

function newBooking(){
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
    jQuery('.change-date-button').hide();
}

jQuery( document ).ready(function() {

    jQuery(document).on("click", "#form-booking .save-button", function (event) {

        if (!jQuery('#frozen_booking').prop('checked')){
            if (jQuery('#name_booking').val() == ''){
                event.preventDefault();
                alert("השם לא מלא");
                return;
            }else if (jQuery('#email_booking').val() == ''){
                event.preventDefault();
                alert("נא למלא את הדוא”ל!");
                return;
            }else if (jQuery('#phone_booking').val() == ''){
                event.preventDefault();
                alert("נא למלא את מס’ הטלפון!");
                return;
            }else if (jQuery('#price_booking').val() == null || jQuery('#price_booking').val() == '' || jQuery('#price_booking').length < 1){
                event.preventDefault();
                alert("המחיר ומספר המשתתפים אינם צוינו!");
                return;
            }
        } else {
            if (jQuery('#price_booking').val() == null || jQuery('#price_booking').val() == '' || jQuery('#price_booking').length < 1){
                event.preventDefault();
                alert("המחיר ומספר המשתתפים אינם צוינו!");
                return;
            }
        }
        jQuery(this).hide();
    });


    /**
     * Change Date & Time button
     */
    jQuery(document).on("click", ".change-date-button", function (event) {

        event.preventDefault();

        jQuery(".alert-calendar").show();
        jQuery(".cell-day").removeClass("selected-day");
        jQuery(".cell-time").removeClass("selected-day");
        is_change_datetime = true;
        jQuery(this).attr('data-room-id', jQuery(input_rooms).val());
        jQuery(this).hide();
        jQuery(button_edit).hide();
        jQuery(button_delete).hide();
        jQuery(container_rooms).hide();
        jQuery(container_time).hide();

    });

    jQuery(document).on("click", "div.cell-day.past-date", function (event) {

    });

    /********* Select a Day *********/
    jQuery(document).on("click", ".cell-day, .fc-today", function (event) {

        if (jQuery(this).attr('data-date-attr') == '')
            return;

        if (jQuery(this).attr('class').indexOf('past-date') > -1){
            // return;
            is_edited = false;
        }else{
            is_edited = true;
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

                if (is_change_datetime){
                    // var room_id = (jQuery(".change-date-button").attr('data-room-id'));
                    jQuery(container_rooms).fadeIn(300);
                    // jQuery(input_rooms).val(room_id).change();
                } else {
                    jQuery(container_rooms).fadeIn(300);
                    jQuery(input_rooms).val(0);
                    jQuery(container_time).hide();
                }

            }
        });

    });

    /********* Select a Day *********/
    jQuery(document).on("click", ".cell-day, .fc-today", function (event) {

        if (jQuery(this).attr('data-date-attr') == '')
            return;

        if (jQuery(this).attr('class').indexOf('past-date') > -1){
            // return;
            is_edited = false;
        }else{
            is_edited = true;
        }

        if (!is_change_datetime) {
            jQuery(table_edit).hide();
            hideNewBooking();
        }

        var days = jQuery("#calendar").find(".cell-day, .fc-today");
        jQuery( days ).each(function( index ) {
            jQuery(days[index]).removeClass(SELECT_CELL);
        });
        jQuery(this).toggleClass(SELECT_CELL);

    });

    /********* Select a Time *********/
    jQuery(document).on("click", ".cell-time", function (event) {

        jQuery("#custom-time-button").hide();

        if (!jQuery(this).hasClass('reserved')){
            jQuery("#custom-time-button").show();
        }

        if (!jQuery(this).hasClass('reserved') && jQuery(this).hasClass('past-time')) {
            event.preventDefault();
            return;
        }

        if (jQuery(this).hasClass('past-time')){
            is_edited = false;
        }else{
            is_edited = true;
        }

        var days = jQuery("#calendar-time").find(".cell-time");
        jQuery( days ).each(function( index ) {
            jQuery(days[index]).removeClass('selected-day');
        });

        jQuery(this).toggleClass("selected-day");
        jQuery(button_delete).show();
        jQuery(button_edit).show();
        jQuery(button_save).hide();
        jQuery('.change-date-button').show();

        if (jQuery(this).hasClass('reserved') && is_change_datetime){
            alert(bkng_messages.date_already_reserved);
            return;
        }

        jQuery("#room_time").val(jQuery('.cell-time.selected-day').attr('data-time'));
        jQuery("#room_date").val(jQuery('.cell-day.selected-day').attr('data-date-attr'));

        if (is_change_datetime) {
            alert(bkng_messages.you_change_date + " " + jQuery("#room_date").val().replace(/\-/g, ".") +", "+ jQuery("#room_time").val());
            jQuery("#form-booking *").prop("disabled", false);
            jQuery('#room_id').val(jQuery('.choose-room').val());
            console.log(jQuery('.choose-room').val());
            jQuery(button_save).click();
            return;
        }

        var booking_id = jQuery(this).attr('data-booking-id');

        jQuery("#booking_id").val(booking_id);
        jQuery("#delete_booking").val(booking_id);

        hideNewBooking();


        if (booking_id){
            spinnerShow();
            BookingInfoAjax(booking_id);
            jQuery(table_edit).show();
        } else {
            jQuery(table_edit).hide();
            showNewBooking();
        }

        setEditable(is_edited);
        updateUrlBookingID();
    });

    /********* Select a Room *********/
    jQuery(input_rooms).on("change", function (event) {
        spinnerShow();

        fillTimes(ROOMS_DATES_TIMES, jQuery(this).val());
        fillRezerved(jQuery(this).val(), ROOMS_DATES_TIMES);

        jQuery(container_time).fadeIn(300);
        disableTodayTimeAdmin();
        jQuery("#custom-time-table").hide();
        // if (!ajax_load_booking)
            jQuery("#custom-time-button").show();
        jQuery("#calendar-time").show();
        jQuery(button_save).show();
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

    jQuery(document).on("click", "#custom-time-button", function(){
        jQuery("#booking_id").val('');
        jQuery(table_edit).hide();
        showNewBooking();

        jQuery("#calendar-time").hide();
        if (!is_edited)
            newBooking();
        jQuery("#custom-time-table").fadeIn(300);
        jQuery("#room_time").val('00:00');
        jQuery(button_edit).click();
        jQuery(this).hide();
    });

    jQuery('#phone_booking').on('keyup', function(){

        var phone = jQuery(this).val();

        if (phone.length < 3)
            return;

        // jQuery.ajax({
        //     url: '/wp-admin/admin-ajax.php',
        //     type: 'POST',
        //     dataType: 'json',
        //     async: false,
        //     data: {
        //         action: 'find_client_by_phone',
        //         phone: phone
        //     },
        //     success: function (data){
        //         console.log(data);
        //     }
        // });

    });

    jQuery('#custom-hour, #custom-minute').on('focusin', function(){
        jQuery(this).data('val', jQuery(this).val());
    });

    jQuery("#custom-hour, #custom-minute").on("change", function (event) {
        spinnerShow();
        var old_val, _this;
        old_val = jQuery(this).data('val');
        _this = jQuery(this);

        if (jQuery(this).val().length < 2){
            jQuery(this).val("0"+jQuery(this).val());
        }

        jQuery("#room_time").val(jQuery("#custom-hour").val() + ":" + jQuery("#custom-minute").val());

        var room_id = jQuery("#room_id").val();
        var room_date = jQuery("#room_date").val();
        var room_time= jQuery("#room_time").val();

        /******* AJAX ******/
        jQuery.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {action: 'get_booking_by_room_date_time', room_id: room_id, room_date:room_date, room_time:room_time},
            success: function (data) {
                result = JSON.parse(data);
                if (result.result == true){
                    alert(room_time + " " + room_date + ' ' + bkng_messages.message_already_booking);
                    _this.val(old_val);
                }
                spinnerHide();
            },
            done: function (data){
                spinnerHide();
            }
        });

    });

});


function showNewBooking() {
    jQuery(container_edit).fadeIn(300);
    newBooking();
    // jQuery(button_new_booking).fadeIn(300);
}


function setEditable(editable) {
    if (!editable){
        jQuery("#delete_booking, .edit-button, .save-button, .change-date-button").hide();
    }else{
        jQuery("#delete_booking, .edit-button, .save-button, .change-date-button").show();
    }
}

function hideNewBooking() {
    // jQuery(button_new_booking).hide();
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

var ajax_load_booking = false;

function BookingInfoAjax(booking_id, onload = false) {

    ajax_load_booking = true;

    /******* AJAX ******/
    jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        async: true,
        data: {action:'get_booking', booking_id:booking_id},
        success: function( data ) {
            var booking = JSON.parse(data);
            if (booking) {

                fillBooking(booking);

                if (onload) {

                    jQuery("#custom-time-button").hide();
                    var sel_date = jQuery(".cell-day.selected-day").attr("data-date-attr");
                    var room_id = booking['room_id'];

                    /******* AJAX ******/
                    jQuery.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        type: 'POST',
                        async: true,
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
                init_calendar('m', 'Y');
            }

            spinnerHide();
        }
    });
    jQuery(container_edit).fadeIn(300);

}

function AutoFillDateTimeBooking(date){
    init_calendar(date.split('-')[1],date.split('-')[2]);
    var days = jQuery("#calendar").find(".cell-day, .fc-today");
    jQuery( days ).each(function( index ) {
        jQuery(days[index]).removeClass(SELECT_CELL);
    });
    console.log("Find date = "+date);
    jQuery("#calendar").find(".cell-day[data-date-attr='"+date+"']").toggleClass(SELECT_CELL);

}

function spinnerShow() {
    jQuery('div.loading').show();
}

function fillBooking(data, clear = false) {

    jQuery("#booking_id").val(data['booking_id']);
    jQuery("#delete_booking").val(data['booking_id']);
    jQuery("#room_time").val(data['room_time']);
    jQuery("#room_date").val(data['room_date']);
    jQuery("#room_id").val(data['room_id']);
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
            var options = '<option disabled value="">----</option>';
            jQuery( prices ).each(function( index ) {
                var selected = '';

                if (amount_price == prices[index]['price']) {
                    selected = 'selected';
                }
                options += '<option '+selected+' value = "' + prices[index]['price'] + '">' + prices[index]['quantity'] + ' - ' + prices[index]['price'] + '</option>';
            });

            if (options.indexOf('selected') < 0){
                options = options.replace("disabled", " selected disabled ")
            }

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

    jQuery(input_rooms).html(options);
}

function fillRezerved(room_id, data) {
    var old_time = [];

    jQuery(data).each(function (index) {
        if (data[index]['room_id'] == room_id){
            if (jQuery('#calendar-time .cell-time[data-time="'+data[index]['room_time']+'"]').length < 1 && data[index]['room_time']){
                var obj = {};
                obj.id = data[index]['id'];
                obj.room_time = data[index]['room_time'];
                old_time.push(obj);
                console.log("Not find time: "+data[index]['room_time']+"="+data[index]['id']);
            }

            jQuery('#calendar-time .cell-time[data-time="'+data[index]['room_time']+'"]').addClass('reserved').attr('data-booking-id', data[index]['id']);
            if (is_change_datetime){
                jQuery('#calendar-time .reserved').remove();
            }
        }
    });
    if (old_time.length < 1)
        return;
    jQuery('.fc-body.calendar-time-body').append('<div class="fc-row old-time"></div>')
    jQuery(old_time).each(function (index) {
        jQuery('.fc-row.old-time').append('<div class="cell-time reserved" data-booking-id="'+old_time[index].id+'" data-time="'+old_time[index].room_time+'"><span class="fc-date">'+old_time[index].room_time+'</span></div>')
    });
}

function countRooms(data, room_id) {
    var result = 0;
    jQuery(data).each(function (index) {
        if (data[index]['id'] != null && data[index]['room_id'] == room_id && (typeof data[index]['booking_frozen'] != 'undefined' && data[index]['booking_frozen'] !== 'on') )
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

function init_calendar(set_month, set_year) {

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
            month : set_month,
            year: set_year

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

function disableTodayTimeAdmin() {
    var curr_date = new Date().getTime();
    var curr_hours = new Date().getHours();
    $('.cell-time').each (function() {
        var item_date = parseInt(convertToDate($('.selected-day').attr('data-date-attr') + ' ' + $(this).attr('data-time')));
        var item_hours = new Date(parseInt(item_date)).getHours();
        if (curr_date > item_date /*&& curr_hours > item_hours*/){
            // console.log("BLOCK " + curr_date + "=" + item_date);
            $(this).addClass('past-time');
        }
    });
}

function convertToDate(dateString) {
    dateTimeParts = dateString.split(' '),
        timeParts = dateTimeParts[1].split(':'),
        dateParts = dateTimeParts[0].split('-');

    var date = new Date(dateParts[2], (parseInt(dateParts[1], 10) - 1), dateParts[0], timeParts[0], timeParts[1]);
    return date.getTime();
}
