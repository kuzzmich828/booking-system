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

);