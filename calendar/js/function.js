

var ROOMS_DATES_TIMES = null;
var input_rooms = "select.choose-room";

$( document ).ready(function() {


    /********* Select a Day *********/
    $(document).on("click", ".cell-day, .fc-today", function (event) {
    // $(".cell-day, .fc-today").click(function (event) {
        spinnerShow();

        var days = $("#calendar").find(".cell-day, .fc-today");
        $( days ).each(function( index ) {
            $(days[index]).removeClass('selected-day');
        });
        $(this).toggleClass("selected-day");

        var sel_date = $(this).attr("data-date-attr");
        /******* AJAX ******/
        $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {action:'get_booking_rooms_by_date', date:sel_date},
            success: function( data ) {
                ROOMS_DATES_TIMES = JSON.parse(data);
                fillRooms(ROOMS_DATES_TIMES);
                spinnerHide();
            }
        });

        $(".step-2").fadeIn(300);
        $(input_rooms).val(0);
        $(".step-3").hide();


    });

    /********* Select a Room *********/
    $(".choose-room").on("change", function (event) {
        spinnerShow();

        fillTimes(ROOMS_DATES_TIMES, $(this).val());
        fillRezerved($(this).val(), ROOMS_DATES_TIMES);

        $(".step-3").fadeIn(300);

        spinnerHide();
    });

    // jQuery('.fw-option-type-select#fw-option-room').on('fw:option-type:select:room', function(event, data){
    //     console.log(data);
    // });

});


function spinnerShow() {
    $('div.loading').show();
}

function spinnerHide() {
    $('div.loading').hide();
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
    // var cells = [];
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