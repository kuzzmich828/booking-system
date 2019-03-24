<?php
//defining the filter that will be used to select posts by 'post formats'
function add_post_formats_filter_to_post_administration(){

    //execute only on the 'post' content type
    global $post_type;
    if($post_type == 'bookings'){
        $rooms = bkng_get_booking_rooms();
        ?>
        <select name="room_name" id="room_name" class="postform" >
            <option value=""><?= __('Room name...', 'bkng'); ?></option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room->ID; ?>"><?= $room->post_title; ?></option>
            <?php endforeach; ?>
        </select>

        <!--  ***********************************************************   -->
        <input  type="date" name="room_date" id="room_date" class="postform" />

        <!--  ***********************************************************   -->
        <select name="room_day" id="room_day" class="postform">
            <option value=""><?= __('Day...', 'bkng'); ?></option>
            <?php
                $days = [
                        __('Sun', 'bkng'),
                        __('Mon', 'bkng'),
                        __('Tue', 'bkng'),
                        __('Wed', 'bkng'),
                        __('Thu', 'bkng'),
                        __('Fri', 'bkng'),
                        __('Sat', 'bkng')
                    ];
            ?>
            <?php foreach ($days as $day): ?>
                <option value="<?= $day; ?>"><?= $day; ?></option>.
            <?php endforeach; ?>
        </select>

        <!--   ***********************************************************   -->
        <select name="status" id="status" class="postform">
            <option value=""><?= __('Status...', 'bkng'); ?></option>
            <option value="frozen"><?= __('Frozen', 'bkng'); ?></option>
            <option value="needapprove"><?= __('Need Approve', 'bkng'); ?></option>
            <option value="approved"><?= __('Approved', 'bkng'); ?></option>
        </select>

        <!--   ***********************************************************   -->
        <select name="subscribe" id="subscribe" class="postform">
            <option value=""><?= __('Subscribe...', 'bkng'); ?></option>
            <option value="on"><?= __('Subscribe', 'bkng'); ?></option>
            <option value="off"><?= __('Not subscribe', 'bkng'); ?></option>
        </select>

<?php

        wp_dropdown_users([
            'show' => 'display_name',
            'echo' => true,
            'name' => 'approved_person',
            'selected' => '',
            'show_option_none' => __('Approved person...','bkng')
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
                }elseif ($status == 'needapprove') {
                    $metakey = 'fw_option:approve';
                    $metaval = 'off';
                }else{
                    $metakey = 'fw_option:frozen';
                    $metaval = 'on';
                }

                $meta_queries [] =
                    array(
                        'key'     => $metakey,
                        'value'   => $metaval,
                        'compare' => '=',
                    );

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

    }

    return $query;
}

add_action('pre_get_posts','add_post_format_filter_to_posts');
