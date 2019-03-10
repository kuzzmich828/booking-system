<?php

// создаем новую колонку
add_filter( 'manage_'.'booking'.'_posts_columns', 'add_views_column', 4 );
function add_views_column( $columns ){
    $num = 2; // после какой по счету колонки вставлять новые

    $new_columns = array(
        'name' => __('Name', 'bkng'),
        'phone' => __('Phone', 'bkng'),
        'amount_price' => __('Price', 'bkng'),
        'room_date' => __('Date', 'bkng'),
        'week_day' => __('Day of Week', 'bkng'),
        'room' => __('Room', 'bkng'),
        'status' => __('Status', 'bkng'),
        'email' => __('Email', 'bkng'),
        'approved_person' => __('Approved Person', 'bkng'),
        'approved_date' => __('Approved Date', 'bkng'),
        'quantity' => __('Quantity', 'bkng'),
        'subscribe' => __('Subscribe', 'bkng'),
        'discount' => __('Subscribe', 'bkng'),
        'amount' => __('Amount', 'bkng'),
    );

    return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

// заполняем колонку данными
add_action('manage_'.'booking'.'_posts_custom_column', 'fill_views_column', 5, 2 );
function fill_views_column( $colname, $post_id ){
    if( $colname === 'name' ){
        echo get_post_meta($post_id, 'fw_option:name', 1);
    }elseif ($colname === 'phone'){
        echo get_post_meta($post_id, 'fw_option:phone', 1);
    }elseif ($colname === 'amount_price'){
        echo get_post_meta($post_id, 'fw_option:amount_price', 1);
    }elseif ($colname === 'room_date'){
        echo get_post_meta($post_id, 'fw_option:room_date', 1) ." ". get_post_meta($post_id, 'fw_option:room_time', 1);
    }elseif ($colname === 'room'){
        echo get_the_title(get_post_meta($post_id, 'fw_option:room', 1));
    }elseif ($colname === 'email'){
        echo  (get_post_meta($post_id, 'fw_option:email', 1));
    }elseif ($colname === 'approved_person'){
        echo (get_post_meta($post_id, 'fw_option:approve_person', 1));
    }elseif ($colname === 'approved_date'){
        echo (get_post_meta($post_id, 'fw_option:approve_time', 1));
    }elseif ($colname === 'quantity'){
        echo (get_post_meta($post_id, 'fw_option:quantity', 1));
    }elseif ($colname === 'subscribe'){
        echo (get_post_meta($post_id, 'fw_option:subscribe', 1));
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
        $date = get_post_meta($post_id, 'fw_option:room_date', 1);
        echo DateTime::createFromFormat("d-m-Y", $date)->format("D");
    }elseif ($colname === 'room'){
        echo  (get_post_meta($post_id, 'fw_option:room', 1));
    }
}

/***************************************** *****************************************/