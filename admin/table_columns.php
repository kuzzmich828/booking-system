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
        'order' => __('Order', 'booking-system'),
        'room' => __('Room', 'booking-system'),
        'room_date' => __('Game Date', 'booking-system'),
        'room_time' => __('Game Time', 'booking-system'),
        /******************/
        'week_day' => __('Day of Week', 'booking-system'),
        'status' => __('Status', 'booking-system'),   // status
        'approved_date' => __('Approved Date', 'booking-system'),     // approved_date
        'approved_person' => __('Approved Person', 'booking-system'), // approved_person
        'booking_created' => __('Created Date', 'booking-system'),
        'name' => __('Name', 'booking-system'),       // name
        'phone' => __('Phone', 'booking-system'),     // phone
        'email' => __('Email', 'booking-system'),     // email
        'subscription' => __('Subscription', 'booking-system'),             // Subscribe
        'quantity' => __('Quantity', 'booking-system'),
        'discount' => __('Discount', 'booking-system'),
        'amount_price' => __('Price', 'booking-system'),
        'amount' => __('Amount', 'booking-system'),
    );

    return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

// заполняем колонку данными
add_action('manage_'.'bookings'.'_posts_custom_column', 'fill_views_column', 5, 2 );
function fill_views_column( $colname, $post_id ){
    if( $colname === 'order' ){
        echo $post_id;
    }elseif( $colname === 'name' ){
        echo get_post_meta($post_id, 'fw_option:name', 1);
    }elseif ($colname === 'phone'){
        echo get_post_meta($post_id, 'fw_option:phone', 1);
    }elseif ($colname === 'email'){
        echo  (get_post_meta($post_id, 'fw_option:email', 1));
    }elseif ($colname === 'amount_price'){
        $frozen = get_post_meta($post_id, 'fw_option:frozen', 1);
        if ($frozen == 'on') {
            echo '-';
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
        }elseif (get_post_meta($post_id, 'fw_option:canceled', 1) == 'on'){
            echo "<strong style='color:darkred;'>canceled</strong>";
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
        }elseif(get_post_meta($post_id, 'fw_option:canceled', 1) == 'on'){
            echo '0';
        }else{
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
add_filter( 'manage_'.'edit-bookings'.'_sortable_columns', 'add_views_sortable_column' );
function add_views_sortable_column( $sortable_columns ){
    $sortable_columns['name'] = [ 'name', false ];
    $sortable_columns['room_date'] = [ 'room_date', false ];
    $sortable_columns['booking_created'] = [ 'booking_created', false ];
    $sortable_columns['approved_date'] = [ 'approved_date', false ];

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

//add_action( 'pre_get_posts', 'add_column_room_date_request' );
//add_action( 'pre_user_query', 'add_column_room_date_request' );

add_action( 'pre_get_posts', 'add_column_name_sort' );
function add_column_name_sort( $user_query ){
    global $current_screen;

    if ( !is_admin() )
        return;

    if ( isset($current_screen->id)  && $current_screen->id != 'edit-bookings' )
        return;

    $vars = $user_query->query_vars;

    if( 'name' === $vars['orderby'] ){
        $user_query->set('meta_key', 'fw_option:name');
        $user_query->set( 'orderby', 'meta_value' );
        $user_query->set( 'order', $vars['order'] );
    } elseif ( 'room_date' === $vars['orderby'] ){
        $user_query->set('meta_key', 'room_date:timestamp');
        $user_query->set( 'orderby', 'meta_value_num' );
        $user_query->set( 'order', $vars['order'] );
    } elseif ( 'approved_date' === $vars['orderby'] ){
        $user_query->set('meta_key', 'fw_option:approve_time');
        $user_query->set( 'orderby', 'meta_value' );
        $user_query->set( 'order', $vars['order'] );
    } elseif ( 'booking_created' === $vars['orderby'] ){
        $user_query->set( 'orderby', 'date' );
        $user_query->set( 'order', $vars['order'] );
    }

}