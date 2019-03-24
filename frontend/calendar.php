<div id="v-cal" class="calendar-block" data-room-id="">
    <div class="vcal-header">
        <button class="vcal-btn" data-calendar-toggle="previous">
            <svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
            </svg>
        </button>
        <div class="vcal-header__label" data-calendar-label="month"></div>
        <button class="vcal-btn" data-calendar-toggle="next">
            <svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
            </svg>
        </button>
    </div>
    <div class="vcal-week">
        <span>Mon</span>
        <span>Tue</span>
        <span>Wed</span>
        <span>Thu</span>
        <span>Fri</span>
        <span>Sat</span>
        <span>Sun</span>
    </div>
    <div class="vcal-body" data-calendar-area="month"></div>
</div>


<p class="demo-picked">
    Date picked:
    <span data-calendar-label="picked"></span>
</p>

<div class="time-table">
    <div class="item time-grid">
        <div class="item_content">11:30</div>
        <div class="item_content">11:30</div>
        <div class="item_content">11:30</div>
        <div class="item_content">11:30</div>
        <div class="item_content">11:30</div>
        <div class="item_content">11:30</div>
        <div class="item_content">11:30</div>
        <div class="item_content">11:30</div>
    </div>
</div>


<link href="<?= plugin_dir_url(__FILE__); ?>/vanillaCalendar.css" rel="stylesheet">
<script src="<?= plugin_dir_url(__FILE__); ?>/vanillaCalendar.js" type="text/javascript"></script>


<script>

    /********** Init Calendar ***********/
    window.addEventListener('load', function () {
        vanillaCalendar.init({
            disablePastDays: true
        });
    });

    /************ Click to DAY **********/
    jQuery(document).on("click", "div.vcal-date", function(){

        var date_calendar = $(this).attr("data-calendar-date");
        var room_id = $('.open-booking').attr('id');

        if (date_calendar){
            $.ajax({
                url: '<?= admin_url(); ?>/admin-ajax.php',
                data: {
                    action: "get_booking_room_date",
                    date: date_calendar,
                    room_id: room_id
                },
                type:'POST',
                success: function(data){
                    console.log(data);
                }

            });
        }

    });


    /************ OPEN Modal Room ***********/

    $('.open-booking').click(function(event){
        $('body').css('overflow-y','hidden');
        $('img.main-icon').hide();
        $('img.order-icon').attr( "style", "display: block !important;" );
        /* присвоить клас всплывающему окну бронирования */
        // $post_id = $(this).parent().attr('id');
        $post_id = $(this).attr('id');

        /* открыть окно бронирования */
        event.preventDefault();
        $('.booking-popup-bg').show();
        $('.booking-popup').show();
        $('.booking-popup-right_preloader').hide();
        /*прокрутить содержимое окна бронирования вверх*/
        $('.booking-popup').scrollTop(0);
        if ($(window).width()<769) $('body').scrollTop(0);

        /*обнулять стиль ячеек (цвет) в выборе времени*/
        $('.time-grid').html('');
        $('.time-grid').hide();

        $.ajax({
              url: '<?= admin_url(); ?>/admin-ajax.php',
              data: {
                  action: "get_room_times",
                  id: $post_id
              },
              type:'POST',
              success: function(data){
                  var times = JSON.parse(data);
                  var time_table = '';
                  $(times).each(function(index){
                      time_table += '<div class="item_content">'+times[index]+'</div>';
                  });
                  $('.time-grid').html(time_table);
              }

        });

        $room_name = $(this).parent().find('h3').html();
        $('.booking-popup h2.room-booking-header').html($room_name);
        $('.booking-form.second-step input[name="order_room"]').val($room_name);

        $room_duration = $(this).parent().find('.room-time').text();
        $('.booking-form.second-step input[name="order_duration"]').val($room_duration);

        $room_content = $(this).parent().find('.room-content').html();
        $('.booking-popup .room-booking-description').html($room_content);

        $room_info = $(this).parent().find('.room-info').html();
        $('.booking-popup .booking-popup-left_bottom-strip').html($room_info);

        $select_info = $(this).parent().attr('id');
        $('.first-step select').val($select_info).change();

        $room_percent = $(this).parent().find('.percent-without-help').html();
        $('.boking-percent-center').html($room_percent);

        $room_textcolor = $(this).parent().find('.room-info').css('color');
        $('.booking-popup-left_bottom-strip').css('color',$room_textcolor);

        $room_bg = $(this).parent().find('.room-info').css('background');
        $room_bg = $room_bg.split('n')[0];

        $('.last-booking, .boking-percent-without-help').css({'background':$room_bg, 'color':$room_textcolor});

        $room_image = $(this).parent().find('.room-popup-thumb').attr('data-image');
        $('.booking-popup-image').css('background-image','url('+$room_image+')');
        /* подгрузка данных бронирования для отображения в попапе, а также подгрузка данных к оформлению (заказа) бронирования */

    });
</script>
<style>

    #v-cal{
        color: #000;
    }

    html {
        font-size: 10px;
    }

    body {
        color: #333;
        font-size: 1.6rem;
        background-color: #FAFAFA;
        -webkit-font-smoothing: antialiased;
    }

    footer {
        text-align: center;
        margin: 1.6rem 0;
    }

    .demo-picked {
        font-size: 1.2rem;
        text-align: center;
    }

    .demo-picked span {
        font-weight: bold;
    }

    .time-table {
        width: 100%;
        padding: 0;
        font-size: 0;
    }

    .item {
        display: inline-block;
        margin: 3px 0;
    }

    .item_content {
        display: inline-block;
        background: #fff;
        font-size: 16px;
        color: #000;
        line-height: 25px;
        text-align: center;
        min-width: 59px;
        min-height: 25px;
        margin-right: 1px;
        margin-bottom: 1px;
        padding: 0;
        cursor: pointer;
    }

</style>