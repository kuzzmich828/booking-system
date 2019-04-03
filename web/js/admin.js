
var input_room = "#fw-option-room";
var input_room_time = "#fw-option-room_time";
var input_room_date = "#fw-option-room_date";
var input_amount_price = "#fw-option-amount_price";
var input_quantity = "#fw-option-quantity";

/***************** Required Fields ********************/
jQuery( document ).ready(function() {

    if (window.location.href.indexOf('post_type=bookings') > -1){
        jQuery("#publish").attr("disabled", true);
    }

    jQuery("input, select").bind("keyup change", function(e) {

        if (
            String(jQuery('#fw-option-room').val()).trim() == '' ||
            String(jQuery('#fw-option-room_date').val()).trim() == '' ||
            String(jQuery('#fw-option-room_time').val()).trim() == '' ||
            String(jQuery('#fw-option-email').val()).trim() == '' ||
            String(jQuery('#fw-option-phone').val()).trim() == '' ||
            String(jQuery('#fw-option-name').val()).trim() == ''
        ){
            jQuery("#publish").attr("disabled", true);
        } else {
            jQuery("#publish").attr("disabled", false);
        }

    });
});


jQuery(document).on("click", "input#publish", function(){
    jQuery(input_room_time).prop("disabled", false);
    jQuery(input_room_date).prop("disabled", false);
    jQuery("#fw-option-room_time option").prop("disabled", false);
});

jQuery(document).on("change", input_room, function (event) {

    var id = $(this).val();
    jQuery(input_room_time).val('');
    jQuery(input_room_date).val('');
    jQuery(input_amount_price).val('');
    jQuery(input_quantity).val('');
    jQuery(input_room_time).prop("disabled", true);
    /******* AJAX ******/
    jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {action:'get_room_attributes', id:id},
        success: function( data ) {
            var response = JSON.parse(data);
            var times = response['times'];
            var prices = response['prices'];
            // var quantity = response['quantity'];
            console.log(prices);
            /********* Fill Input Time ******/
            var options = '';
            jQuery(input_room_date).prop("disabled", false);
            jQuery( times ).each(function( index ) {
                options += '<option value = "'+times[index]+'">'+times[index]+'</option>';
            });
            jQuery(input_room_time).html(options);


            /********* Fill Input Price & Quantity ******/
            options = '';
            jQuery( prices ).each(function( index ) {
                console.log(prices[index]);
                options += '<option value = "'+prices[index]['price']+'">'+prices[index]['quantity'] + ' - ' + prices[index]['price'] +'</option>';
            });
            jQuery(input_amount_price).html(options);

        }
    });

});

jQuery(document).on("changeDate", input_room_date, function (event) {

        var selected_date = $(this).val();
        var room_id = $(input_room).val();

        /******* AJAX ******/
        jQuery.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {action: 'get_booking_room_date', room_id: room_id, date: selected_date},
            success: function (data) {
                var times = JSON.parse(data);
                jQuery(input_room_time).prop("disabled", false);

                var options = jQuery(input_room_time + " option");
                jQuery(options).each(function (index) {
                    jQuery(options[index]).prop("disabled", false);
                });

                jQuery(times).each(function (index) {
                    jQuery(input_room_time + " option[value='" + times[index] + "']").prop("disabled", true);
                });

            }
        });

});
