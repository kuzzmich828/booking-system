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

        <div id="wrapper-quest__dis_wrapper" class="wrapper-quest__dis_wrapper">

        </div>
        <div class="wrapper-quest__dis_block"><?= fw_get_db_settings_option('text_for_price'); ?></div>

        <input id="pol" class="quest_politics-js" type="checkbox" name="quest_politics">
        <label for="pol" class="wrapper-quest__pol_required">
            <span><?= fw_get_db_settings_option('text_for_agreement'); ?></span>
        </label>
        <br>
        <input id="sub" type="checkbox" class="quest_subscription-js" name="quest_subscription" checked>
        <label for="sub" class="wrapper-quest__want_to_subsc">
            <span><?= fw_get_db_settings_option('text_for_subscribe'); ?></span>
        </label>

        <input id="button-step-2" type="submit" name="quest_submit" class="wrapper-quest__widget_button" value="הזמן עכשיו">
    </form>
</div>
