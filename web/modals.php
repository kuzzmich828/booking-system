<div class="wrapper-quest">
    <!-- BG -->
    <div id="wrapper-quest__container" >

        <img  src="" alt="" class="wrapper-quest__background">
        <div id="wrapper-quest__close"></div>

        <div id="wrapper-quest__modal1" class="wrapper-quest__modal">
            <div class="wrapper-quest__content">
                <div class="wrapper-quest__whiteline">
                    <div class="wrapper-quest__whiteline_header-left">
                        <span class="header">המשחק הוזמן לאחרונה לפני</span>
                        <span class="time last-order-time-js">2:57:2</span>
                    </div>
                </div>
                <h2 class="quest__room_name">אלקטרז תא שני</h2>
                <div class="wrapper-quest__descripription"></div>

                <div class="wrapper-quest__whiteline_bottom">
                    <div class="wrapper-quest__complexity">
                        <img class="time-icon-js" alt="" src="<?= plugin_dir_url(__FILE__); ?>img/escape-timeicon-gotgrey.png">
                        <div class="wpcf-icon-text-color time-text-js"> רמת קושי גבוהה </div>
                    </div>

                    <div class="wrapper-quest__people">
                        <img class="people-icon-js" alt="" src="<?= plugin_dir_url(__FILE__); ?>img/escape-peopleicon-gotgrey.png">
                        <div class="wpcf-icon-text-color people-text-js">  עד 6 משתתפים</div>
                    </div>

                    <div class="wrapper-quest__time">
                        <img class="complexity-icon-js" alt="" src="<?= plugin_dir_url(__FILE__); ?>img/escape-time-gotgray.png">
                        <div class="wpcf-icon-text-color complexity-text-js"> 60 דקות אתגר</div>
                    </div>

                    <div class="wrapper-quest__age-info">
                        <img class="age-icon-js" alt="" src="<?= plugin_dir_url(__FILE__); ?>img/escape-ageicon-gotgrey.png">
                        <div class="wpcf-icon-text-color age-text-js">12+</div>
                    </div>
                </div>
                <div class="wrapper-quest__whiteline_header-right">
                    <div>רק<br><span>%</span></div>
                    <div class="wrapper-quest__center percent-js">0</div>
                    <div>משחקנים יוצאים ללא רמז</div>
                </div>

                <!-- RELATED ROOMS -->

            </div>

            <?php include __DIR__ . '/modal-1.php'; ?>
            <?php include __DIR__ . '/modal-2.php'; ?>

            <div class="wrapper-quest__other-quest">
                <?php
                $related_rooms = get_posts([
                    'post_type'=>'room',
                    'posts_per_page'=>-1,
                    'post_status'=>'publish',
                ]);
                foreach ($related_rooms as $related_room):

                    $bg_color = get_post_meta($related_room->ID,'fw_option:background_color',true);
                    $rest = (!$bg_color) ? "8e7878" : mb_substr($bg_color, 1);
                    $split = str_split($rest, 2);
                    $r = hexdec($split[0]);
                    $g = hexdec($split[1]);
                    $b = hexdec($split[2]);
            ?>
                    <div class="wrapper-quest__item" data-room-id="<?= $related_room->ID; ?>" data-room-name="<?= $related_room->post_title; ?>">
                        <div class="wrapper-quest-other-quest__img">
                            <?php $url_room_img = get_the_post_thumbnail_url($related_room->ID); ?>
                            <img src="<?= ($url_room_img) ? $url_room_img : '//funeral-nsk.ru/wp-content/uploads/2018/06/thumbnail.png'; ?>" alt="<?= $related_room->post_title; ?>">
                        </div>
                        <div class="wrapper-quest-other-quest__title" style="color:<?php echo "rgba(" . $r . ", " . $g . ", " . $b . ");"; ?>"><?= $related_room->post_title; ?></div>
                        <div class="wrapper-quest-other-quest__button" style="<?php echo "background: rgba(" . $r . ", " . $g . ", " . $b . ", 0.7);"; ?>"><a class="re-open-booking" data-room-id="<?= $related_room->ID; ?>" data-room-name="<?= $related_room->post_title; ?>" href="#">הזמן עכשיו</a></div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>

        </div>

        <?php include __DIR__ . '/modal-3.php'; ?>

    </div>

</div>


<!--<link href="//fonts.googleapis.com/css?family=Assistant:300,400,700,800" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="<?= plugin_dir_url(__FILE__); ?>css/main.css?ver=<?= EDIT_VER; ?>"/>
<link href="<?= plugin_dir_url(__FILE__); ?>../frontend/vanillaCalendar.css?ver=<?= EDIT_VER; ?>" rel="stylesheet">
<script src="<?= plugin_dir_url(__FILE__); ?>../frontend/vanillaCalendar.js?ver=<?= EDIT_VER; ?>" type="text/javascript"></script>
<script src="<?= plugin_dir_url(__FILE__); ?>../web/order.js?ver=<?= EDIT_VER; ?>" type="text/javascript"></script>