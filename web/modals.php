
<div class="wrapper-quest">


    <!-- BG -->
    <div id="wrapper-quest__container" >
        <img src="<?= plugin_dir_url(__FILE__); ?>/img/bg.jpg" alt="" class="wrapper-quest__background">
        <div id="wrapper-quest__close"></div>

        <div id="wrapper-quest__modal1" class="wrapper-quest__modal">
            <div class="wrapper-quest__content">
                <div class="wrapper-quest__whiteline">
                    <div class="wrapper-quest__whiteline_header-left">
                        <span class="header">המשחק הוזמן לאחרונה לפני</span>
                        <span class="time">2:57:2</span>
                    </div>
                </div>
                <h2 class="quest__room_name">אלקטרז תא שני</h2>
                <div class="wrapper-quest__descripription"></div>

                <div class="wrapper-quest__whiteline_bottom">
                    <div class="wrapper-quest__complexity">
                        <img alt="" src="<?= plugin_dir_url(__FILE__); ?>img/escape-timeicon-gotgrey.png">
                        רמת קושי גבוהה
                    </div>

                    <div class="wrapper-quest__people">
                        <img alt="" src="<?= plugin_dir_url(__FILE__); ?>img/escape-peopleicon-gotgrey.png">
                        עד 6 משתתפים
                    </div>

                    <div class="wrapper-quest__time">
                        <img alt="" src="<?= plugin_dir_url(__FILE__); ?>img/escape-time-gotgray.png">
                        60 דקות אתגר
                    </div>

                    <div class="wrapper-quest__age-info">
                        <img alt="" src="<?= plugin_dir_url(__FILE__); ?>img/escape-ageicon-gotgrey.png">
                        12+
                    </div>
                </div>
                <div class="wrapper-quest__whiteline_header-right">
                    <div>רק<br><span>%</span></div>
                    <div class="wrapper-quest__center">0</div>
                    <div>משחקנים יוצאים ללא רמז</div>
                </div>

                <div class="wrapper-quest__other-quest">
                    <?php
                        $related_rooms = get_posts([
                                                'post_type'=>'room',
                                            ]);
                        foreach ($related_rooms as $related_room):
                    ?>
                        <div class="wrapper-quest__item">
                            <div class="wrapper-quest-other-quest__img">
                                <?php $url_room_img = get_the_post_thumbnail_url($related_room->ID); ?>
                                <img src="<?= ($url_room_img) ? $url_room_img : 'http://funeral-nsk.ru/wp-content/uploads/2018/06/thumbnail.png'; ?>" alt="<?= $related_room->post_title; ?>">
                            </div>
                            <div class="wrapper-quest-other-quest__title" style="color:#9c8c78"><?= $related_room->post_title; ?></div>
                            <div class="wrapper-quest-other-quest__button"><a class="re-open-booking" data-room-id="<?= $related_room->ID; ?>" data-room-name="<?= $related_room->post_title; ?>" href="#">הזמן עכשיו</a></div>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>

            </div>

            <?php include __DIR__ . '/modal-1.php'; ?>
            <?php include __DIR__ . '/modal-2.php'; ?>

        </div>

        <?php include __DIR__ . '/modal-3.php'; ?>

    </div>

</div>

<link href="https://fonts.googleapis.com/css?family=Assistant:300,400,700,800" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/wp-content/plugins/booking-system/web/css/main.css"/>
<link href="<?= plugin_dir_url(__FILE__); ?>../frontend/vanillaCalendar.css" rel="stylesheet">
<script src="<?= plugin_dir_url(__FILE__); ?>../frontend/vanillaCalendar.js" type="text/javascript"></script>
<script src="<?= plugin_dir_url(__FILE__); ?>../web/order.js" type="text/javascript"></script>
