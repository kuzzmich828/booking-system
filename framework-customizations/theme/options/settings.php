<?php if (!defined( 'FW' )) die('Forbidden');

$options = array(
    'text_under_timetable' => [
        'type'  => 'text',
        'value' => 'להזמנת משחק ל 00:00 ויותר מאוחר, מומלץ להתייעץ עם הנציג',
        'label' => __('Text after time-table', 'booking-system'),
    ],
    'text_for_price' => [
        'type'  => 'text',
        'value' => 'סה”כ מחיר עבור משחק',
        'label' => __('Text for price', 'booking-system'),
    ],
    'text_for_subscribe' => [
        'type'  => 'text',
        'value' => 'אני מעוניין לקבל עדכונים והטבות בדוא"ל',
        'label' => __('Text for subscribe', 'booking-system'),
    ],
    'text_for_agreement' => [
        'type'  => 'textarea',
        'value' => 'מאשר שקראתי את <a href="/תנאי-ההזמנה/" data-wahfont="17">תנאי ההזמנה</a> מאתר ומסכים איתם',
        'label' => __('Text for agreement', 'booking-system'),
    ],

    'logo_site' => [
        'type'  => 'upload',
        'label' => __('Site Logo', 'booking-system'),
    ],

    'logo_mail' => [
        'type'  => 'upload',
        'label' => __('Email Logo', 'booking-system'),
    ],

    'email_phone' => [
        'type'  => 'text',
        'label' => __('Phone in footer E-Mail', 'booking-system'),
    ],

    'email_phone_1' => [
        'type'  => 'text',
        'label' => __('Phone 2 in footer E-Mail', 'booking-system'),
    ],

    'user_can_delete' => [
        'type'  => 'select-multiple',
        'choices' => array( 
        ),
        'label' => __('Users can DELETE', 'booking-system'),
    ],
);

$wp_users = get_users();
foreach ($wp_users as $wp_user){
    $options['user_can_delete']['choices'][$wp_user->ID] = $wp_user->display_name;
}