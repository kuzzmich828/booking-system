<?php
//defining the filter that will be used to select posts by 'post formats'
function add_post_formats_filter_to_post_administration(){

    //execute only on the 'post' content type
    global $post_type;
    if($post_type == 'bookings'){
        $rooms = bkng_get_booking_rooms();
        ?>
        <select name="room_name" id="room_name" class="postform" >
            <option value=""><?= __('Room name...', 'booking-system'); ?></option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room->ID; ?>"><?= $room->post_title; ?></option>
            <?php endforeach; ?>
        </select>

        <!--  ***********************************************************   -->
        <input type="text" onfocus="(this.type='date')"  name="room_date" id="room_date" class="postform" placeholder="תאריך משחק"/>

        <!--  ***********************************************************   -->
        <select name="week_day" id="week_day" class="postform">
            <option value=""><?= __('Day...', 'booking-system'); ?></option>
            <?php
                $days = [
                        __('Sun', 'booking-system'),
                        __('Mon', 'booking-system'),
                        __('Tue', 'booking-system'),
                        __('Wed', 'booking-system'),
                        __('Thu', 'booking-system'),
                        __('Fri', 'booking-system'),
                        __('Sat', 'booking-system')
                    ];
            ?>
            <?php foreach ($days as $day): ?>
                <option value="<?= $day; ?>"><?= $day; ?></option>.
            <?php endforeach; ?>
        </select>

        <!--   ***********************************************************   -->
        <select name="status" id="status" class="postform">
            <option value=""><?= __('Status...', 'booking-system'); ?></option>
            <option value="frozen"><?= __('Frozen', 'booking-system'); ?></option>
            <option value="needapprove"><?= __('Need Approve', 'booking-system'); ?></option>
            <option value="approved"><?= __('Approved', 'booking-system'); ?></option>
        </select>

        <!--   ***********************************************************   -->
        <select name="subscribe" id="subscribe" class="postform">
            <option value=""><?= __('Subscribe...', 'booking-system'); ?></option>
            <option value="on"><?= __('Subscribe', 'booking-system'); ?></option>
            <option value="off"><?= __('Not subscribe', 'booking-system'); ?></option>
        </select>

<?php

        wp_dropdown_users([
            'show' => 'display_name',
            'echo' => true,
            'name' => 'approved_person',
            'selected' => '',
            'show_option_none' => __('Approved person...','booking-system')
        ]);

    }
}



add_action('restrict_manage_posts','add_post_formats_filter_to_post_administration');

function add_post_format_filter_to_posts($query){

    global $post_type, $pagenow;
    $meta_queries = [];

    if($pagenow == 'edit.php' && $post_type == 'bookings'){

        /************************************ ***************************/
        if(isset($_GET['room_name'])){
            $room_name = sanitize_text_field($_GET['room_name']);
            if($room_name){
                $meta_queries [] =
                    array(
                        'key'     => 'fw_option:room',
                        'value'   => $room_name,
                        'compare' => '=',

                );
            }
        }

        /************************************ ***************************/
        if(isset($_GET['room_date'])){
            $room_date = sanitize_text_field($_GET['room_date']);
            if($room_date){

                $room_date = DateTime::createFromFormat("Y-m-d", $room_date);
                if ($room_date){
                    $meta_queries [] =
                        array(
                            'key'     => 'fw_option:room_date',
                            'value'   => $room_date->format("d-m-Y"),
                            'compare' => '=',
                    );
                }

            }
        }

        /************************************ ***************************/
        if(isset($_GET['status'])){
            $status = sanitize_text_field($_GET['status']);
            if($status){

                if ($status == 'approved'){
                    $metakey = 'fw_option:approve';
                    $metaval = 'on';
                }elseif($status == 'frozen'){
                    $metakey = 'fw_option:frozen';
                    $metaval = 'on';
                }


                if($status == 'needapprove') {
                    $meta_queries [] = [
                        array('AND'),
                        array(
                            'key'     => 'fw_option:approve',
                            'value'   => 'off',
                            'compare' => '=',
                        ),
                        array(
                            'key'     => 'fw_option:frozen',
                            'value'   => 'off',
                            'compare' => '=',
                        )
                    ];
                } else {
                    $meta_queries [] =
                        array(
                            'key'     => $metakey,
                            'value'   => $metaval,
                            'compare' => '=',
                        );
                }

            }
        }

        /************************************ ***************************/
        if(isset($_GET['approved_person'])){
            $approved_person = sanitize_text_field($_GET['approved_person']);
            if($approved_person && $approved_person > 0){

                $meta_queries [] =
                    array(
                        'key'     => 'fw_option:approve_person',
                        'value'   => get_user_by('ID', $approved_person)->nickname,
                        'compare' => '=',
                    );

            }
        }
        $query->set( 'meta_query', [ array_merge(['AND'], $meta_queries) ] );

        /************************************ ***************************/
        if(isset($_GET['subscribe'])){
            $subscribe = sanitize_text_field($_GET['subscribe']);
            if($subscribe){

                $meta_queries [] =
                    array(
                        'key'     => 'fw_option:subscription',
                        'value'   => $subscribe,
                        'compare' => '=',
                    );

            }
        }
        $query->set( 'meta_query', [ array_merge(['AND'], $meta_queries) ] );

        /************************************ ***************************/
        if(isset($_GET['week_day'])){
            $week_day = sanitize_text_field($_GET['week_day']);
            if($week_day){

                $meta_queries [] =
                    array(
                        'key'     => 'room_date:week_day',
                        'value'   => $week_day,
                        'compare' => '=',
                    );

            }
        }
        $query->set( 'meta_query', [ array_merge(['AND'], $meta_queries) ] );


    }

    return $query;
}

add_action('pre_get_posts','add_post_format_filter_to_posts');
