<!-- Modal 2 widget-->
<div id="modal-2" class="wrapper-quest__widget">
    <form class="wrapper-quest__form" method="post" action="/thanks-page/">

        <div class="wrapper-quest__datetime"></div>
        <!-- datetime-wrapper -->
        <div class="wrapper-quest__datetime_block">
            יתאריך: <span class="wrapper-quest__date quest__date-js">10.4.2019</span>
            <span class="wrapper-quest__strip">|</span>
            שעה:
            <span class="wrapper-quest__time quest__time-js">16:30</span>
        </div><!-- datetime-block -->

        <input required="" type="text" name="quest_fullname" placeholder="* שם מלא">
        <input required="" type="email" name="quest_email" placeholder="* דוא”ל">
        <input required="" type="tel" name="quest_phone" placeholder="* טלפון / נייד">
        <span class="wrapper-quest__span">* משתתפים במשחק</span>
        <select id="quest__quantity" name="wrapper-quest__quantity">
        </select>
        <!--                    <div class="clearfix"></div>-->


        <div id="wrapper-quest__dis_wrapper" class="wrapper-quest__dis_wrapper"> </div>
        <div class="wrapper-quest__dis_block">סה”כ מחיר עבור משחק <strong>לפני</strong> הנחה</div>

        <input id="pol" type="checkbox" name="quest_politics" checked>
        <label for="pol" class="wrapper-quest__pol_required">
            <span>מאשר שקראתי את <a href="/תנאי-ההזמנה/">תנאי ההזמנה</a> מאתר ומסכים איתם</span>
        </label>
        <br>
        <input id="sub" type="checkbox" name="quest_subscription">
        <label for="sub" class="wrapper-quest__want_to_subsc">
            <span>אני מעוניין לקבל עדכונים והטבות בדוא"ל</span>
        </label>

        <!--<input type="hidden" name="quest_date" value="10.4.2019">-->
        <!--<input type="hidden" name="quest_day" value="10">-->
        <!--<input type="hidden" name="quest_month" value="4">-->
        <!--<input type="hidden" name="quest_year" value="2019">-->
        <!--<input type="hidden" name="quest_time" value="16:30">-->
        <!--<input type="hidden" name="quest_room" value="המהלכים הלבנים">-->
        <!--<input type="hidden" name="quest_room_name">-->
        <!--<input type="hidden" name="quest_price" value="220">-->
        <!--<input type="hidden" name="quest_duration" value="60 דקות אתגר">-->

        <input id="button-step-2" type="submit" name="quest_submit" class="wrapper-quest__widget_button" value="הזמן עכשיו">
    </form>
</div>
