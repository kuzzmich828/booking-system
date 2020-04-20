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
    $name  = get_bloginfo( 'name' );
    $url  = site_url();
    $logo  = wp_get_attachment_image_url(fw_get_db_settings_option('logo_mail')['attachment_id']);
    $phone_0  = fw_get_db_settings_option('email_phone');
    $phone_1  = fw_get_db_settings_option('email_phone_1');
    $is_phone_2 = ($phone_1) ? 'border-right:2px solid #eee35e;' : '';
    $message =
        <<< HTML
        <body style="text-align:right; font-size:18px;">
        <table border="0" cellpadding="0" cellspacing="0"  style="width:600px; margin-left:auto; margin-right:auto;">
        <tr style="background-color:#000; color:#efe45e;  text-align:center; border-bottom:1px solid #efe45e;">
        <td style="padding-top:35px; padding-bottom:35px; border-bottom:1px solid #fff;  padding-left:100px; padding-right:100px;">
            <img src="$logo" alt="" style="width:200px; height:auto; display:block; margin-left:auto; margin-right:auto; margin-bottom:5px;"/>
            <a href="$url" style="color:#efe45e; text-decoration:none; font-size:14px;">$name</a></td>
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
            <tr style="background-color:#000; border-top:1px solid #fff">
                <td style="padding-top:30px; padding-bottom:10px; text-align:center; border-top:1px solid #fff;  padding-left:100px; padding-right:100px;">
                    <table style="text-align:center; margin-left:auto; margin-right:auto;">
                        <tr>
                            <td style='font-size:24px; $is_phone_2 padding-right:15px; color:#fff; margin-bottom:5px; padding-top:0px; padding-bottom:0px;'>$phone_0</td>
                            <td style='font-size:24px; padding-left:8px; color:#fff; padding-top:0px; padding-bottom:0px;'>$phone_1</td>
                        </tr>
                    </table>
                </td>
            </tr>
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
