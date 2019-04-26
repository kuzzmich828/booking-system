document.addEventListener("DOMContentLoaded", function () {

    var button1 = jQuery('.open-booking'),
        button2 = document.getElementById('button-step-1'),
        button3 = document.getElementById('button-step-2'),
        // wrapperQuestButtons = document.getElementById('wrapper-quest__buttons'),
        wrapperQuestContainer = document.getElementById('wrapper-quest__container'),
        // wrapperQuestQuantity = document.getElementById('wrapper-quest__quantity'),
        wrapperQuestDisWrapper = document.getElementById('wrapper-quest__dis_wrapper'),
        modal1 = document.getElementById('wrapper-quest__modal1'),
        modal3 = document.getElementById('wrapper-quest__modal3'),
        widget1 = document.getElementById('modal-1'),
        widget2 = document.getElementById('modal-2'),
        close = document.getElementById('wrapper-quest__close');

    button1.click(function(e){

        e.preventDefault();

        // $(wrapperQuestButtons).addClass('hide');
        $(wrapperQuestContainer).addClass('show');
        $(modal1).addClass('show');
        $(widget1).addClass('show');
        // $(widget2).addClass('show');

        /* ****************************** */
        $('body').css('overflow-y','hidden');
        $post_id = $(this).attr('id');
        $room_name = $(this).attr('data-room-name');
        $room_id = $(this).attr('data-room-id');
        console.log("room-name =", $room_name, "room_id =",$room_id);

        if (!$room_id){
            $room_id = false;
        }else if($room_name){
            alert("Error room");
        }

        /*прокрутить содержимое окна бронирования вверх*/
        $('.booking-popup').scrollTop(0);
        if ($(window).width()<769) $('body').scrollTop(0);

        $('.time-grid').html('');
        $('.time-grid').hide();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: "get_room_attributes",
                id: $room_id,
                room_name: $room_name
            },
            type:'POST',
            success: function(data){
                var response = JSON.parse(data);

                if ($.isEmptyObject(response)) {

                    close_all_modal();
                }
                var times = response['times'];
                var prices = response['prices'];
                var time_table = '';
                var prices_table = '';

                /* *************************************** */
                $(times).each(function(index){
                    time_table += '<div class="item_content" data-time-room="'+times[index]+'">'+times[index]+'</div>';
                });
                $('.time-grid').html(time_table);

                /* *************************************** */
                $(prices).each(function(index){
                    prices_table += '<option value="'+prices[index]['price']+'">'+prices[index]['quantity']+ ' - ' +prices[index]['price']+'</option>';
                });
                $("#quest__quantity").html(prices_table);
                $(".wrapper-quest__descripription").html(response['description']);
                $(".quest__room_name").html(response['room_name']);

            }

        });

    });

    button2.addEventListener('click', function (e) {
        e.preventDefault();
        // $(wrapperQuestButtons).addClass('hide');
        $(wrapperQuestContainer).addClass('show');
        $(modal1).addClass('show');
        $(widget1).removeClass('show');
        $(widget1).addClass('hide');
        $(widget2).addClass('show');
        /* ****************************************** */
        /* ****************************************** */
        /* ****************************************** */
        var selected_date = $(".vcal-date.selected-day").attr("data-calendar-date");
        var selected_time = $(".selected-time").attr("data-time-room");

        $('.quest__time-js').html(selected_time);
        $('.quest__date-js').html(selected_date);
    });

    button3.addEventListener('click', function (e) {
        e.preventDefault();



        var name = $("input[name='quest_fullname']").val();
        var email =$("input[name='quest_email']").val();
        var phone =$("input[name='quest_phone']").val();

        var selected_date = $(".vcal-date.selected-day").attr("data-calendar-date");
        var selected_time = $(".selected-time").attr("data-time-room");
        var room_id = $(button1).attr('id');
        var price = $('#quest__quantity').val();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: "create_booking",
                room_id: room_id,
                name_booking: name,
                email_booking: email,
                phone_booking: phone,
                room_date: selected_date,
                room_time: selected_time,
                price: price,
            },
            type:'POST',
            success: function(data){
                var response = JSON.parse(data);


                // $(wrapperQuestButtons).addClass('hide');
                $(wrapperQuestContainer).addClass('show');
                $(modal1).removeClass('show');
                $(modal1).addClass('hide');

                $('#order_game').html(response['room_name']);
                $('#order_date').html(response['room_date']);
                $('#order_time').html(response['room_time']);
                $('#order_quantity').html(response['quantity']);
                $('#order_place').html('order_place');
                $('#order_mail').html(response['email']);
                $('#order_phone').html(response['phone']);
                $('#order_value').html('order_value');


                $(modal3).addClass('show');
            }

        });



    });

    close.addEventListener('click', function () {
        close_all_modal();
    });

    function close_all_modal() {
        wrapperQuestContainer.classList.remove("show");

        modal1.classList.remove("show");
        modal3.classList.remove("show");
        widget1.classList.remove("show");
        widget2.classList.remove("show");
        // wrapperQuestButtons.classList.remove("show");

        modal1.classList.remove('hide');
        modal3.classList.remove("hide");
        widget1.classList.remove("hide");
        widget2.classList.remove("hide");
        // wrapperQuestButtons.classList.remove("hide");
    }
    /*wrapperQuestQuantity.addEventListener('change', function (e) {
        wrapperQuestDisWrapper.innerHTML = e.target.value;
    });*/
});



/********** Init Calendar ***********/
window.addEventListener('load', function () {
    vanillaCalendar.init({
        disablePastDays: true
    });
});

/*************** ***********************/
/*jQuery(document).on("click", ".booking-submit", function(){
    alert();

    var name = $("input[name='order_fullname']").val();
    var email =$("input[name='order_email']").val();
    var phone =$("input[name='order_phone']").val();

    console.log(name);
    console.log(email);
    console.log(phone);
    // $(".f-step").hide();
    // $(".s-step").show();
    // $(".second-step").show();
    // var time_room = $(this).attr("data-time-room");
    // var room_id = $('.open-booking').attr('id');
});
*/

/************ Click to TIME **********/
jQuery(document).on("click", ".item_content", function(){

    if ($(this).hasClass('reserv'))
        return;
    var time_room = $(this).attr("data-time-room");
    var room_id = $('.open-booking').attr('id');

    console.log(time_room);
    console.log(room_id);
    $(".item_content").removeClass("selected-time");
    $(this).addClass("selected-time");

    $(".booking-time").html(time_room);
    $(".booking-date").html($(".vcal-date.selected-day").attr("data-calendar-date"));

});

/************ Click to DAY **********/
jQuery(document).on("click", "div.vcal-date", function(){

    var date_calendar = $(this).attr("data-calendar-date");
    var room_id = $('.open-booking').attr('id');
    $("div.vcal-date").removeClass("reserv").removeClass("selected-day");
    $("div.item_content").removeClass("reserv").removeClass("selected-day");

    $(this).addClass("selected-day");

    if (date_calendar){
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: "get_booking_room_date",
                date: date_calendar,
                room_id: room_id
            },
            type:'POST',
            success: function(data){
                var response = JSON.parse(data);
                $(response).each(function(index){
                    $(".item_content[data-time-room='"+response[index]+"']").addClass("reserv");
                    console.log(response[index])
                });
                $('.time-grid').show();
            }

        });
    }
});


