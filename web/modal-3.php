<!-- Modal 3 -->
<div id="wrapper-quest__modal3" class="wrapper-quest__modal">

    <div class="wrapper-quest__container-relative">
        <h1>הזמנתכם התקבלה בהצלחה, תודה.</h1>
        <h2 class="wrapper-quest__h2">בזמן הקרוב נציגנו יצרו איתכם קשר לאישור הזמנה ותשלום פיקדון (100₪)</h2>
        <h3>לדוא"ל שהוקש נשלחו פרטי הזמנה.</h3>
        <div class="wrapper-quest__feedback-wrapper">

            <h4>פרטי הזמנה</h4>
            <div class="clearfix"></div>
            <div class="wrapper-quest__thanks-left">
                <table>
                    <tbody>
                    <tr>
                        <td >משחק:</td> <!-- Game -->
                        <td id="order_game"></td>
                    </tr>
                    <tr>
                        <td >תאריך:</td> <!-- Date -->
                        <td id="order_date"></td>
                    </tr>
                    <tr>
                        <td >שעה:</td>   <!-- Time -->
                        <td id="order_time"></td>
                    </tr>
                    <tr>
                        <td >משתתפים:</td>   <!--Quantity-->
                        <td id="order_quantity"></td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- thanks-left -->
            <div class="wrapper-quest__thanks-right">
                <table>
                    <tbody>
                    <tr>
                        <td>שם:</td>        <!-- Place -->
                        <td id="order_place"></td>
                    </tr>
                    <tr>
                        <td>דוא”ל:</td>     <!-- Mail -->
                        <td id="order_mail"></td>
                    </tr>
                    <tr>
                        <td>טלפון:</td>     <!-- Phone -->
                        <td id="order_phone"> </td>
                    </tr>
                    <tr>
                        <td>ערך:</td>       <!-- Value -->
                        <td id="order_value"></td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- thanks-right -->
            <div class="clearfix"></div>

        </div><!-- feedback wrapper -->

        <div class="wrapper-quest__feedback-social">

            <ul class="wrapper-quest__menu-social">
                <li>
                    <a target="_blank" href="https://www.facebook.com/"
                       class="menu-image-title-after menu-image-not-hovered">
                        <img width="30" height="31" src="<?= plugin_dir_url(__FILE__); ?>img/s-1.png" alt="">
                        <span>פייסבוק</span>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://www.instagram.com/"
                       class="menu-image-title-after menu-image-not-hovered">
                        <img width="30" height="31" src="<?= plugin_dir_url(__FILE__); ?>img/s-2.png" alt="">
                        <span>אינסטגרם</span>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://www.google.com/maps/">
                        <img width="31" height="31" src="<?= plugin_dir_url(__FILE__); ?>img/s-3.png" alt="">
                        <span>מפת גוגל</span>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://www.waze.com/">
                        <img width="30" height="29" src="<?= plugin_dir_url(__FILE__); ?>img/s-4.png" alt="">
                        <span>וויז</span>
                    </a>
                </li>
            </ul>
        </div>

        <a href="/" class="wrapper-quest__button-back">לעמוד הבית</a>

    </div>
</div>