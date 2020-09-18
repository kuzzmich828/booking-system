var selected_room_id = null;

document.addEventListener("DOMContentLoaded", function () {

    var button1 = jQuery('.open-booking'),
        button2 = document.getElementById('button-step-1'),
        button3 = document.getElementById('button-step-2'),
        open_related_quest = jQuery('.re-open-booking'),
        // wrapperQuestButtons = document.getElementById('wrapper-quest__buttons'),
        wrapperQuestContainer = document.getElementById('wrapper-quest__container'),
        // wrapperQuestQuantity = document.getElementById('wrapper-quest__quantity'),
        wrapperQuestDisWrapper = document.getElementById('wrapper-quest__dis_wrapper'),
        modal1 = document.getElementById('wrapper-quest__modal1'),
        modal3 = document.getElementById('wrapper-quest__modal3'),
        widget1 = document.getElementById('modal-1'),
        widget2 = document.getElementById('modal-2'),
        close = document.getElementById('wrapper-quest__close');

    open_related_quest.click(function(e){
        e.preventDefault();
        close_all_modal();
        open_1_modal($(this));
    });

    button1.click(function(e){
        e.preventDefault();
        open_1_modal($(this));
    });

    button2.addEventListener('click', function (e) {
        e.preventDefault();
        $(wrapperQuestContainer).addClass('show');
        $(modal1).addClass('show');
        $(widget1).removeClass('show');
        $(widget1).addClass('hide');
        $(widget2).addClass('show');
        $(button3).addClass('show');
        /* ****************************************** */
        /* ****************************************** */
        /* ****************************************** */
        var selected_date = $(".vcal-date.selected-day").attr("data-calendar-date");
        var selected_time = $(".selected-time").attr("data-time-room");

        $('.quest__time-js').html(selected_time);
        $('.quest__date-js').html(selected_date.replace(/\-/g, "."));

    });

    button3.addEventListener('click', function (e) {
        e.preventDefault();

        var name = $("input[name='quest_fullname']").val();
        var email =$("input[name='quest_email']").val();
        var phone =$("input[name='quest_phone']").val();
        var subscription = $('.quest_subscription-js').prop('checked');
        var selected_date = $(".vcal-date.selected-day").attr("data-calendar-date");
        var selected_time = $(".selected-time").attr("data-time-room");
        var room_id = selected_room_id;//$(button1).attr('id');
        var price = $('#quest__quantity').val();

        if (!name){
            alert("השם לא מלא");
            return;
        }else if (!email){
            alert("נא למלא את הדוא”ל!");
            return;
        }else if (!phone){
            alert("נא למלא את מס’ הטלפון!");
            return;
        }else if ($('.quest_politics-js').prop('checked') !== true){
            alert('נא לקרוא את תנאי ביצוע הזמנה ולאשר אותם!');
            return;
        }else if (price == '' || !price){
            alert('נא לציין כמות המשתתפים!');
            return;
        }

        jQuery(this).addClass('hide');

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
                subscription: subscription
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
                $('#order_place').html(response['name']);
                $('#order_mail').html(response['email']);
                $('#order_phone').html(response['phone']);
                $('#order_value').html(response['amount_price']);


                $(modal3).addClass('show');
            }

        });



    });

    close.addEventListener('click', function () {
        close_all_modal();
    });

    function close_all_modal() {

        window.history.pushState("", "", "/" );

        wrapperQuestContainer.classList.remove("show");
        $('.booking-popup-right-agent').hide();
        modal1.classList.remove("show");
        modal3.classList.remove("show");
        widget1.classList.remove("show");
        widget2.classList.remove("show");
        // wrapperQuestButtons.classList.remove("show");

        modal1.classList.remove('hide');
        modal3.classList.remove("hide");
        widget1.classList.remove("hide");
        widget2.classList.remove("hide");

        $('body').removeClass('overlay');

        jQuery("#button-step-2").removeClass('hide');
        // button3.classList.addClass('hide');


        jQuery("#button-step-1").css('display','none');
        jQuery("#button-step-2").css('display','none');
        // wrapperQuestButtons.classList.remove("hide");
    }

    function open_1_modal(element) {
        // $(wrapperQuestContainer).addClass('show');
        // $(modal1).addClass('show');
        // $(widget1).addClass('show');

        /* ****************************** */
        $('body').css('overflow-y','hidden');
        $post_id = element.attr('id');
        $room_name = element.attr('data-room-name');
        $room_id = element.attr('data-room-id');
        console.log("Open modal. Room-name:", $room_name, "Room-id:", $room_id);

        // ********* Set URL *******/
        if ($room_name) {
            jQuery('.wrapper-quest__item').show();
            if (!$room_id || $room_id == 'undefined') {
                $room_id = findRoomByName($room_name);

            }
            console.log($room_name, $room_id);
            if (window.location.href.indexOf("room_id") < 0)
                window.history.pushState("", "", window.location.href + '?room_id=' + $room_id);
            else
                window.history.pushState("", "", window.location.href.replace(/room_id=[0-9]{0,6}/gi, 'room_id=' + $room_id));
        }


        $this = element;

        if (!$room_id){
            $room_id = false;
        }else if(!$room_name){
            alert("Error room");
        }
        jQuery('.wrapper-quest__item[data-room-id='+$room_id+']').hide();
        console.log("Hide related=", $room_id);
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

                $('body').addClass('overlay');

                /********** Fill icons ***********/

                $('.time-text-js').html(response['time_text']);

                $('.wrapper-quest__background').attr('src', response['room_image']);
                $('.people-text-js').html(response['people_text']);
                $('.age-text-js').html(response['age_text']);
                $('.complexity-text-js').html(response['complexity_text']);

                $('.time-icon-js').attr('src', response['time_icon']['url']);
                $('.people-icon-js').attr('src', response['people_icon']['url']);
                $('.age-icon-js').attr('src',response['age_icon']['url']);
                $('.complexity-icon-js').attr('src',response['complexity_icon']['url']);
                $('.percent-js').html(response['percent']);

                $('.wpcf-icon-text-color').css('color', response['icon_text_color']);
                var c_color = ((response['modal_corner_color'])) ? hexToRgbA(response['modal_corner_color']) : 'rgba(135, 183, 234, 0.7)';
                $('.wrapper-quest__whiteline_header-left, .wrapper-quest__whiteline_header-right').css('background', c_color);
                /********** Fill icons ***********/

                selected_room_id = response['room_id'];
                if (!$this.attr('data-room-id'))
                    $this.attr('data-room-id', response['room_id']);

                $(".last-order-time-js").html(response['last_order']);
                console.log("Get room attributes:", response);

                if ($.isEmptyObject(response)) {
                    close_all_modal();
                }

                var times = response['times'];
                var prices = response['prices'];
                var time_table = '';
                var prices_table = '<option value="" disabled selected>---</option>';

                /* *************************************** */
                $(times).each(function(index){
                    time_table += '<div class="item_content" data-time-room="'+times[index]+'">'+times[index]+'</div>';
                });
                $('.time-grid').html(time_table);

                /* *************************************** */
                $(prices).each(function(index){
                    prices_table += '<option value="'+prices[index]['price']+'">'+prices[index]['quantity']+ ' - ' +prices[index]['price']+' ₪</option>';
                });
                $("#quest__quantity").html(prices_table);
                $("#wrapper-quest__dis_wrapper").html('₪ '+prices[0]['price']);

                $(".wrapper-quest__descripription").html(response['description']);
                $(".quest__room_name").html(response['room_name']);
                // $(".quest__room_name").css("color", response['title_color']);

                $(wrapperQuestContainer).addClass('show');
                $(modal1).addClass('show');
                $(widget1).addClass('show');

                if (typeof elementorFrontend != 'undefined')
                    elementorFrontend.init();
            }

        });
    }

});

jQuery(document).on("change", "#quest__quantity", function(){
    $("#wrapper-quest__dis_wrapper").html('₪ '+ $(this).val());
});


/********** Init Calendar ***********/
window.addEventListener('load', function () {
    vanillaCalendar.init({
        disablePastDays: true
    });
});


/************ Click to TIME **********/
jQuery(document).on("click", ".item_content", function(){

    if ($(this).hasClass('reserv') || $(this).hasClass('past-time'))
        return;
    var time_room = $(this).attr("data-time-room");
    var room_id = $('.open-booking').attr('id');

    console.log(time_room);
    console.log(room_id);
    $(".item_content").removeClass("selected-time");
    $(this).addClass("selected-time");

    $(".booking-time").html(time_room);
    $(".booking-date").html($(".vcal-date.selected-day").attr("data-calendar-date"));
    $("#button-step-1").css('display','block');

});

var calendar_today = false;
/************ Click to DAY **********/
jQuery(document).on("click", "div.vcal-date", function(e){

    e.preventDefault();
    $('.booking-popup-right-agent').hide();
    if ($(this).hasClass('vcal-date--disabled'))
        return;

    calendar_today = false;
    if ($(this).hasClass('vcal-date--today'))
        calendar_today = true;

    var date_calendar = $(this).attr("data-calendar-date");
    var room_id = selected_room_id;
    $("#button-step-1").css('display','none');
    $("div.vcal-date").removeClass("reserv").removeClass("selected-day");
    $("div.item_content").removeClass("reserv").removeClass("selected-day");

    $(this).addClass("selected-day");

    console.log("Get bookings by date:", date_calendar, "Room-id:", room_id);

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
                console.log("Get bookings response:", response);
                $(response).each(function(index){
                    $(".item_content[data-time-room='"+response[index]+"']").addClass("reserv");
                    console.log(response[index])
                });

                if (calendar_today) {
                    disableTodayTime();
                } else {
                    $('.item_content').removeClass('past-time');
                }

                $('.time-grid').show();
                $('.booking-popup-right-agent').show();

            }

        });
    }
});


function disableTodayTime() {
    var curr_date = new Date().getTime();
    $('.item_content').each (function() {
        var item_date = convertToDate($('.selected-day').attr('data-calendar-date') + ' ' + $(this).attr('data-time-room'));
        if (curr_date > item_date){
            $(this).addClass('past-time');
        }
    });
}
function convertToDate(dateString) {
    // var dateString = '17-09-2013 10:08',
        dateTimeParts = dateString.split(' '),
        timeParts = dateTimeParts[1].split(':'),
        dateParts = dateTimeParts[0].split('-');

    var date = new Date(dateParts[2], parseInt(dateParts[1], 10) - 1, dateParts[0], timeParts[0], timeParts[1]);
    return date.getTime();
}

function hexToRgbA(hex){
    var c;
    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
        c= hex.substring(1).split('');
        if(c.length== 3){
            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c= '0x'+c.join('');
        return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',1)';
    }
    throw new Error('Bad Hex');
}