<div class="second-step">
    <form class="booking-form second-step" method="post" action="/thanks-page/">

        <div class="datetime-wrapper"></div>

        <div class="datetime-block">יתאריך: <span class="booking-date">30.05.2018</span>
            <span class="datetime-block-strip">|</span>
            שעה: <span class="booking-time">12:00</span></div>


        <input required type="text" name="order_fullname" placeholder="<?= __('Name','booking-system'); ?> *"/>
        <input required type="email" name="order_email" placeholder="<?= __('E-mail','booking-system'); ?> *"/>
        <input required type="tel" name="order_phone" placeholder="<?= __('Phone','booking-system'); ?> *"/>
        <span class="booking-span"><?= __('Participants of the game','booking-system'); ?> *</span>
        <select name="order_quantity"></select>

        <div class="clearfix"></div>

        <div class="booking-pr-without-dis-wrapper">booking-pr-without-dis-wrapper</div>
        <div class="booking-pr-without-dis-block"><?= __('Participants of the game','booking-system'); ?></div>

        <div class="booking-pr-with-dis-wrapper">booking-pr-with-dis-wrapper</div>
        <div class="booking-pr-with-dis-block">סה”כ מחיר עבור משחק <strong>אחרי</strong> הנחה</div>

        <label class="activelb politicslb pol_required">
            <input type="checkbox" name="order_politics"/>
            <span>מאשר שקראתי את <a href="/תנאי-ההזמנה/">תנאי ההזמנה</a> מאתר ומסכים איתם</span></label>
        <br/>
        <label class="politicslb want_to_subsc">
            <input type="checkbox" name="order_subscription"/>
            <span>אני מעוניין לקבל עדכונים והטבות בדוא"ל</span>
        </label>

        <input type="hidden" name="order_date">
        <input type="hidden" name="order_day">
        <input type="hidden" name="order_month">
        <input type="hidden" name="order_year">
        <input type="hidden" name="order_time">
        <input type="hidden" name="order_room">
        <input type="hidden" name="order_room_name">
        <input type="hidden" name="order_price">
        <input type="hidden" name="order_duration">

        <input type="submit" name="order_submit" class="booking-submit" value="הזמן עכשיו">
    </form>
</div>