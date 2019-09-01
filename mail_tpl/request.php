<?php

function mail_request($fullname, $email, $phone, $quantity, $date, $time, $room, $price, $duration, $action, $subscription)
{
    bkng_write_log("SEND MAIL $action: $fullname|$email|$phone|$quantity|$date|$time|$room|$price");
    $admin_email = get_option('admin_email');
    $query = new WP_Query('post_type=mails&p=' . $action);
    if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post();
            $mail_title_1 = get_post_meta(get_the_id(), 'wpcf-mail-header-1-w', true);
            $mail_title_2 = get_post_meta(get_the_id(), 'wpcf-mail-header-2-w', true);
            $mail_title_3 = get_post_meta(get_the_id(), 'wpcf-mail-header-3-w', true);
            $mail_title_4 = get_post_meta(get_the_id(), 'wpcf-mail-header-4-w', true);
            $mail_title_5 = wpautop(get_post_meta(get_the_id(), 'wpcf-mail-header-5-w', true));
            $mail_text = wpautop(get_the_content());
        endwhile;
    endif;
    $subject = 'Booking Escapequest ' . $date;
    $message =
<<< HTML
        <body style="text-align:right; font-size:18px;">
        <table border="0" cellpadding="0" cellspacing="0"  style="width:600px; margin-left:auto; margin-right:auto;">
        <tr style="background-color:#000; color:#efe45e;  text-align:center; border-bottom:1px solid #efe45e;">
        <td style="padding-top:35px; padding-bottom:35px; border-bottom:1px solid #fff;  padding-left:200px; padding-right:200px;">
            <img src="http://escape.get-great.site/wp-content/themes/escape/images/logo.png" alt="" style="width:200px; height:auto; display:block; margin-left:auto; margin-right:auto; margin-bottom:5px;"/>
            <a href="http://www.escapeilat.com" style="color:#efe45e; text-decoration:none; font-size:14px;">www.escapeilat.com</a></td>
        </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" style="width:600px; margin-left:auto; margin-right:auto; table-layout:fixed;  border-left:1px solid #c0c0c0; border-right:1px solid #c0c0c0; padding-left:32px; padding-right:32px; border-top:1px solid #efe45e;">
HTML;

    if ($mail_title_1 != '') {
        $message .= '<tr style="font-size:48px;"><td style="padding-top:45px; direction:rtl; ">' . $mail_title_1 . ' <strong>' . $fullname . '!</strong></d></tr>';
    }
    if ($mail_title_2 != '') {
        $message .= '<tr style="font-size:24px;"><td style="padding-top:5px; direction:rtl; ';
        if ($action == 798) {
            $message .= 'padding-bottom:30px;';
        }
        $message .= '">' . $mail_title_2 . '</td></tr>';
    }
    if ($mail_title_3 != '') {
        $message .= "<tr style='font-size:18px; padding-bottom:30px;'><td style='padding-top:15px; border-bottom:2px solid #efe45e; padding-bottom:40px; direction:rtl;'>" . $mail_title_3 . "</td></tr>";
    }
    if ($mail_title_4 != '') {
        $message .= "<tr><td style='padding-top:30px; padding-bottom:0px; font-size:24px; direction:rtl; border-top:2px solid #efe45e;'>" . $mail_title_4 . "</td></tr>";
    }
    $message .=
<<< HTML
            <tr>
            <table style='width:100%;' border='0' cellpadding='0' cellspacing='0'>
            <tr>
            <td style='padding-bottom:45px; padding-top:15px;'>
            <table border='0' cellpadding='0' cellspacing='0' style='border-right:1px solid #c0c0c0; margin-right:30px; font-size:18px; width:100%; float:left;'>
            <tr><td style='padding-bottom:10px; direction:rtl; padding-bottom:10px;'> $room </td><td style='color:#c0c0c0; padding-right:30px; direction:rtl; padding-bottom:10px;'>משחק:</td></tr>
            <tr><td style='padding-bottom:10px; direction:rtl; padding-bottom:10px;'> $date </td> <td style='color:#c0c0c0; padding-right:30px; direction:rtl; padding-bottom:10px;'>תאריך:</td></tr>
            <tr><td style='padding-bottom:10px; direction:rtl; padding-bottom:10px;'> $time </td> <td style='color:#c0c0c0; padding-right:30px; direction:rtl; padding-bottom:10px;'>שעה:</td></tr>
            <tr><td style='padding-bottom:10px; direction:rtl; padding-bottom:10px;'> $duration </td><td style='color:#c0c0c0; padding-right:30px; direction:rtl; padding-bottom:10px;'>משך המשחק:</td></tr>
            <tr><td style='padding-bottom:10px; direction:rtl;'>$quantity</td><td style='color:#c0c0c0; padding-right:30px; direction:rtl; padding-bottom:10px;'>משתתפים:</td></tr>
            </table>
            </td>
            <td style='padding-top:0px; padding-bottom:45px; float:right;'>
            <table border='0' cellpadding='0' cellspacing='0' style='font-size:18px; width:100%;'>
            <tr><td style='padding-bottom:10px; direction:rtl;'>$fullname</td><td style='color:#c0c0c0; direction:rtl; padding-top:0px; padding-bottom:10px;'>שם:</td></tr>
            <tr><td style='padding-bottom:10px;'><a href='#' style='color:#000; text-decoration:none; direction:rtl;'>$email </a></td><td style='color:#c0c0c0; direction:rtl; padding-bottom:10px;'>דוא”ל:</td></tr>
            <tr><td style='padding-bottom:10px; direction:rtl;'>$phone</td><td style='color:#c0c0c0; direction:rtl; padding-bottom:10px;'>טלפון:</td></tr>
            <tr><td style='padding-bottom:10px; direction:rtl; padding-bottom:10px;'> $price </td><td style='color:#c0c0c0; direction:rtl;  padding-bottom:10px;'>מחיר:</td></tr>
            <tr><td style="padding-bottom:10px;">&ensp;</td><td style="color:#c0c0c0; direction:rtl; padding-bottom:10px;">&ensp;</td></tr>
            </table>
            </td>
            </tr>
            </table>
            </tr>
HTML;


    if ($mail_title_5 != '') {
        $message .= '<tr style="background:#efe45e; text-align:center; font-size:18px; line-height:36px; margin-top:15px; margin-bottom:15px;"><td style="direction:rtl; padding-left:20px; padding-right:20px;">';
        $message .= $mail_title_5;
        $message .= "</td></tr>";
    }
    $message .= "<tr style=''><td style='padding-top:20px; padding-bottom:20px; border-top:2px solid #eee35e; '>";
    $message .= $mail_text;
    $message .=
<<< HTML
        </td></tr>
        </table> 
        <table border="0" cellpadding="0" cellspacing="0"  style="width:600px; margin-left:auto; margin-right:auto; border-top:1px solid #efe45e;">
        <tr style="background-color:#000; border-top:1px solid #fff"><td style="padding-top:30px; padding-bottom:10px; text-align:center; border-top:1px solid #fff;  padding-left:100px; padding-right:100px;">
        <a href="https://www.waze.com/ru/location?ll=29.54853057%2C34.96459007&navigate=yes&zoom=17" target="_blank"><img src="http://escape.get-great.site/wp-content/themes/escape/images/s-4.png" alt="" style="margin-left:7px; margin-right:7px; margin-bottom:5px;"/></a>
        <a href="#" target="_blank"><img src="http://escape.get-great.site/wp-content/themes/escape/images/s-5.png" alt="" style="margin-left:7px; margin-right:7px; margin-bottom:5px;"/></a>
        <a href="https://www.google.com/maps/place/%D7%90%D7%A1%D7%A7%D7%99%D7%99%D7%A4+%D7%A8%D7%95%D7%9D+-+%D7%97%D7%93%D7%A8%D7%99+%D7%94%D7%91%D7%A8%D7%99%D7%97%D7%94+%D7%94%D7%92%D7%93%D7%95%D7%9C%D7%99%D7%9D+%D7%91%D7%90%D7%99%D7%9C%D7%AA%E2%80%AD/@29.5483911,34.964738,19z/data=!4m5!3m4!1s0x0:0x2a7565760e253354!8m2!3d29.5482777!4d34.9644348" target="_blank"><img src="http://escape.get-great.site/wp-content/themes/escape/images/s-3.png" alt="" style="margin-left:7px; margin-right:7px; margin-bottom:5px;"/></a>
        <a href="https://www.instagram.com/escape.room.eilat/" target="_blank"><img src="http://escape.get-great.site/wp-content/themes/escape/images/s-2.png" alt="" style="margin-left:7px; margin-right:7px; margin-bottom:5px;"/></a>
        <a href="https://www.facebook.com/escapegameilat/" target="_blank"><img src="http://escape.get-great.site/wp-content/themes/escape/images/s-1.png" alt="" style="margin-left:7px; margin-right:7px; margin-bottom:5px;"/></a>
        <table style="text-align:center; margin-left:auto; margin-right:auto;"><tr>
        <td style='font-size:24px; border-right:2px solid #eee35e; padding-right:15px; color:#fff; margin-bottom:5px; padding-top:0px; padding-bottom:0px;'>053-3555049</td>
        <td style='font-size:24px; padding-left:8px; color:#fff; padding-top:0px; padding-bottom:0px;'>053-8843555</td>
        </tr></table>
        </td></tr>
        </table></body>
HTML;

    remove_all_filters('wp_mail_from');
    remove_all_filters('wp_mail_from_name');

    $headers = array(
        'From: Escapequest <' . $admin_email . '>',
        'content-type: text/html',
    );

    wp_mail($admin_email, $subject, $message, $headers);
    wp_mail($email, $subject, $message, $headers);
}