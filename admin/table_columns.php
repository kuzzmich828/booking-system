<?php

add_filter('manage_bookings_posts_columns', 'column_order', 9999);
function column_order($columns) {
    $n_columns = array();
    $move = 'date'; // what to move
    $before = 'name'; // move before this
    foreach($columns as $key => $value) {
        if ($key==$before){
            $n_columns[$move] = $move;
        }
        $n_columns[$key] = $value;
    }
    return $n_columns;
}

add_filter('months_dropdown_results', '__return_empty_array');

// создаем новую колонку
add_filter( 'manage_'.'bookings'.'_posts_columns', 'add_views_column', 4 );
function add_views_column( $columns ){
    $num = 2; // после какой по счету колонки вставлять новые

    $new_columns = array(
        'room' => __('Room', 'bkng'),
        'room_date' => __('Game Date', 'bkng'),
        'room_time' => __('Game Time', 'bkng'),
        /******************/
        'week_day' => __('Day of Week', 'bkng'),
        'status' => __('Status', 'bkng'),   // status
        'approved_date' => __('Approved Date', 'bkng'),     // approved_date
        'approved_person' => __('Approved Person', 'bkng'), // approved_person
        'booking_created' => __('Created Date', 'bkng'),
        'name' => __('Name', 'bkng'),       // name
        'phone' => __('Phone', 'bkng'),     // phone
        'email' => __('Email', 'bkng'),     // email
        'subscription' => __('Subscription', 'bkng'),             // Subscribe
        'quantity' => __('Quantity', 'bkng'),
        'discount' => __('Discount', 'bkng'),
        'amount_price' => __('Price', 'bkng'),
        'amount' => __('Amount', 'bkng'),
    );

    return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

// заполняем колонку данными
add_action('manage_'.'bookings'.'_posts_custom_column', 'fill_views_column', 5, 2 );
function fill_views_column( $colname, $post_id ){
    if( $colname === 'name' ){
        echo get_post_meta($post_id, 'fw_option:name', 1);
    }elseif ($colname === 'phone'){
        echo get_post_meta($post_id, 'fw_option:phone', 1);
    }elseif ($colname === 'email'){
        echo  (get_post_meta($post_id, 'fw_option:email', 1));
    }elseif ($colname === 'amount_price'){
        $frozen = get_post_meta($post_id, 'fw_option:frozen', 1);
        if ($frozen == 'on') {
            echo '0';
        }else {
            echo get_post_meta($post_id, 'fw_option:amount_price', 1);
        }
    }elseif ($colname === 'room_date'){
        echo str_replace("-", ".", get_post_meta($post_id, 'fw_option:room_date', 1));
    }elseif ($colname === 'room'){
        echo get_the_title(get_post_meta($post_id, 'fw_option:room', 1));
    }elseif ($colname === 'approved_person'){
        echo (get_post_meta($post_id, 'fw_option:approve_person', 1));
    }elseif ($colname === 'approved_date'){
        $approve_time = get_post_meta($post_id, 'fw_option:approve_time', 1);
        if ($approve_time)
            echo date("d.m.Y H:i", strtotime($approve_time));
    }elseif ($colname === 'quantity'){
        echo (get_post_meta($post_id, 'fw_option:quantity', 1));
    }elseif ($colname === 'subscription'){
        echo (get_post_meta($post_id, 'fw_option:subscription', 1));
    }elseif ($colname === 'discount'){
        echo (get_post_meta($post_id, 'fw_option:discount', 1)) ."%";
    }elseif ($colname === 'status'){
        $frozen = get_post_meta($post_id, 'fw_option:frozen', 1);
        if ($frozen == 'on') {
            echo "frozen";
        }elseif (get_post_meta($post_id, 'fw_option:approve', 1) == 'on'){
            echo "approve";
        }else{
            echo "need approve";
        }
    }elseif ($colname === 'week_day'){
        echo get_post_meta($post_id, 'room_date:week_day', 1);
    }elseif ($colname === 'room'){
        echo  (get_post_meta($post_id, 'fw_option:room', 1));
    }elseif ($colname === 'amount'){
        $frozen = get_post_meta($post_id, 'fw_option:frozen', 1);
        if ($frozen == 'on') {
            echo '0';
        }else {
            echo get_post_meta($post_id, 'amount', 1);
        }
    }elseif ($colname === 'subscribe'){
        echo get_post_meta($post_id, 'subscribe', 1);
    }elseif ($colname === 'room_time'){
        echo get_post_meta($post_id, 'fw_option:room_time', 1);
    }elseif ($colname === 'booking_created'){
        echo get_the_date('d.m.Y H:i',$post_id);
    }

}

/***************************************** *****************************************/


// добавляем возможность сортировать колонку
add_filter( 'manage_'.'edit-booking'.'_sortable_columns', 'add_views_sortable_column' );
function add_views_sortable_column( $sortable_columns ){
    $sortable_columns['name'] = [ 'name_name', false ];
    $sortable_columns['amount'] = [ 'amount', false ];
    $sortable_columns['room_date'] = [ 'room_date', false ];
    // false = asc (по умолчанию)
    // true  = desc

    return $sortable_columns;
}

// изменяем запрос при сортировке колонки
add_action( 'pre_get_posts', 'add_column_amount_request' );
function add_column_amount_request( $query ){
    if( ! is_admin()
        || ! $query->is_main_query()
        || $query->get('orderby') !== 'amount'
    )
        return;

    $query->set( 'meta_key', 'amount' );
    $query->set( 'orderby', 'meta_value_num' );
}

add_action( 'pre_get_posts', 'add_column_room_date_request' );
function add_column_room_date_request( $query ){
    if( ! is_admin()
        || ! $query->is_main_query()
        || $query->get('orderby') !== 'room_date'
    )
        return;

    $query->set( 'meta_key', 'room_date:timestamp' );
    $query->set( 'orderby', 'meta_value_num' );

}

add_action( 'pre_get_posts', 'add_column_week_day_request' );
function add_column_week_day_request( $query ){
    if(  is_admin()
        && isset($_GET['week_day'])
        && $_GET['week_day']
    ) {
        $query->set('meta_key', 'room_date:week_day');
        $query->set('meta_value', $_GET['week_day']);
    }
}

add_action( 'pre_get_posts', 'add_column_subscribe_request' );
function add_column_subscribe_request( $query ){
    if(  is_admin()
        && isset($_GET['subscribe'])
        && $_GET['subscribe']
    ) {
        $query->set('meta_key', 'fw_option:subscription');
        $query->set('meta_value', $_GET['subscribe']);
    }
}




