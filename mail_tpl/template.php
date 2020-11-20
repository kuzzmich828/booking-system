<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <style>
        /* hebrew */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 300;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzamW5O7w.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 300;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzZmW5O7w.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 300;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzaGW5.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* hebrew */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 400;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzamW5O7w.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 400;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzZmW5O7w.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 400;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzaGW5.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* hebrew */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 700;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzamW5O7w.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 700;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzZmW5O7w.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 700;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzaGW5.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* hebrew */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 800;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzamW5O7w.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 800;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzZmW5O7w.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Assistant';
            font-style: normal;
            font-weight: 800;
            src: url(//fonts.gstatic.com/s/assistant/v6/2sDcZGJYnIjSi6H75xkzaGW5.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        * {
            margin: 0;
            padding: 0;
            font-size: 100%;
            font-family: 'Assistant', 'Avenir Next', 'sans-serif';
            line-height: 1.65;
        }

        img {
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }

        body,
        .body-wrap {
            width: 100% !important;
            height: 100%;
            background: #FFF;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #71bc37;
            text-decoration: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .button {
            display: inline-block;
            color: white;
            background: #71bc37;
            border: solid #71bc37;
            border-width: 10px 20px 8px;
            font-weight: bold;
            border-radius: 4px;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-bottom: 5px;
            line-height: 1;
        }

        h1 {
            font-size: 32px;
        }

        h2 {
            font-size: 24px;
            font-weight: normal;
            line-height: 32px;
        }

        h3 {
            font-size: 24px;
        }

        h4 {
            font-size: 20px;
        }

        h5 {
            font-size: 16px;
        }

        p, ul, ol {
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .container {
            display: block !important;
            clear: both !important;
            margin: 0 auto !important;
            max-width: 580px !important;
        }

        .row-1 p {
            font-size: 18px;
        }

        .container table {
            width: 100% !important;
            border-collapse: collapse;
        }

        .container .masthead {
            padding: 65px 0;
            background: #000000;
            background-position: center;
            background-size: 130px;
            background-repeat: no-repeat;
            border-bottom: 2px solid #eee35e;
            color: white;
        }


        .container .mastfooter {
            padding: 35px 0 0 0;
            background: #000000;
            background-position: top;
            background-size: 40px;
            background-repeat: no-repeat;
            border-top: 2px solid #eee35e;
            color: white;
            background-position-y: 27px;
        }

        .container .masthead h1 {
            margin: 0 auto !important;
            max-width: 90%;
            text-transform: uppercase;
        }

        .container .content {
            direction: rtl;
            background: white;
            padding: 30px 35px;
        }

        .content.gray {
            background-color: #f2f2f2;
        }

        .container .content.footer {
            background: none;
        }

        .container .content.footer p {
            margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 14px;
        }

        .container .content.footer a {
            color: #888;
            text-decoration: none;
            font-weight: bold;
        }

        ul {
            list-style: none;
            margin-left: 0;
            padding-left: 0;
        }

        li {
            padding: 3px;
            text-indent: -1em;
        }

        li:before {
            content: "*";
            padding: 0 5px;
            color: red;
        }

        .main-table {
            border: 1px solid #c8c8c8;
        }

        a {
            text-decoration: underline;
        }

        table.room-info tr:nth-child(1) td {
            background-color: #eee35e;
            border: solid 3px #f2f2f2;
            word-break: break-all;
        }

        .truncate {
            width: 165px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .table-time tr td:nth-child(1) {
            color: #808080;
            font-weight: lighter;
        }

        .table-time tr td:nth-child(2) {
            color: #000000;
            font-weight: normal;
        }

        .room-info span {
            color: #FFFFFF;
        }

        .footer-link li {
            display: inline-block;
            list-style: none;
            margin-right: 8px;
            font-size: small;
            padding-right: 8px;

        }

        .footer-link li:before {
            content: none;
        }

        ul.footer-link li:last-child {
            border: none;
        }

        ul.footer-link li:not(:last-child):after {
            content: "|";
            color: #ffffff;
            margin-left: 10px;
        }

        a {
            color: #eee35e;
        }

        .bann {
            /*max-height: 130px;*/
            width: 100%;
            border: 2px solid #ccc;
        }

        .imgHolder {
            position: relative;
            text-align: center;
            color: white;
        }

        .top-right {
            position: absolute;
            top: 2px;
            right: 2px;
            padding: 1px 5px;
            background: #FFFFFF;
            color: #8e8e8e;
            font-size: small;
            border-left: 2px solid #cccccc;
            border-bottom: 2px solid #cccccc;
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">

            <!-- Message start -->
            <table class="main-table">
                <tr>
                    <td align="center" class="masthead" style="background-image: url(<?= $email_main_logo; ?>);">
                    </td>
                </tr>
        <!--    ===========================================================    -->
                <tr>
                    <td class="content row-1">
                        <?= $header_content; ?>
                    </td>
                </tr>

        <!--    ===========================================================    -->
                <tr style="background-color: #ccc;" >
                    <td class="content gray row-2">

                        <h2>מדיניות</h2>

                        <table class="room-info">
                            <tr style="font-size: 14px;">
                                <td style="width:33%;padding: 0 6px;"><span>התנת</span> התנהגות  </td>
                                <td style="width:33%;padding: 0 6px;"><span >התנהגות</span>  <?= $booking['phone']; ?> </td>
                                <td style="width:33%;padding: 0 6px;"><span>התנהגות</span> <?= str_replace('-','.', $booking['room_date']); ?> </td>
                            </tr>
                            <tr style="border-top: 15px solid #f2f2f2;">
                                <td colspan="2">
                                    <table class="table-time">
                                        <tr>
                                            <td style="width:50%; background-color:unset;">
                                                <div class="truncate">התנהגות..........................</div>
                                            </td>
                                            <td class="truncate" style="width:50%; background-color:unset;"><?= $booking['room_time']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="truncate">xxxxxxxx..........................</div>
                                            </td>
                                            <td class="truncate"><?= $room_wpcf_time; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="truncate">התנהגות..........................</div>
                                            </td>
                                            <td class="truncate">?????</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="truncate">התנהגותהתנהגותהתנהגות...................</div>
                                            </td>
                                            <td class="truncate"><?= $booking['discount']; ?>%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="truncate">התנהגות..........................</div>
                                            </td>
                                            <td class="truncate"> <?= $booking['amount_price']; ?> ₪ </td>
                                        </tr>

                                    </table>
                                </td>

                                <td colspan="1">
                                    <table>
                                        <tr><td><img src="<?= $room_image; ?>"></td></tr>
                                        <tr><td style="background-color: #eee35e; color: white;"><?= $booking['room_name']; ?></td></tr>
                                    </table>
                                </td>

                            </tr>
                        </table>

                    </td>
                </tr>

        <!--    ===========================================================    -->
                <tr>
                    <td class="content row-3">

                        <div class="imgHolder">
                            <img class="bann" src="<?= $email_banner_image; ?>">
                            <div class="top-right"><?= $email_banner_caption; ?></div>
                        </div>

                    </td>
                </tr>

        <!--    ===========================================================    -->
                <tr style="background-color: #ccc;">
                    <td class="content gray">
                        <?= $email_block_3_content; ?>
                    </td>
                </tr>
        <!--    ===========================================================    -->
                <tr>
                    <td class="content">

                        <?= $email_block_4_content; ?>

                    </td>
                </tr>
        <!--    ===========================================================    -->
                <tr>
                    <td align="center" class="mastfooter" style="background-image: url(<?= $email_footer_logo; ?>);">
                        <table>
                            <tr>
                                <td style="text-align: right; padding: 0 30px;"><?= $email_pnone_1; ?></td>
                                <td style="text-align: left; padding: 0 30px;"><?= $email_pnone_1; ?></td>
                            </tr>
                            <tr >
                                <td  colspan="2" style="padding: 10px 150px; text-align: center;">
                                    <ul class="footer-link">
                                        <?php foreach ($email_footer_menu as $item): ?>
                                            <li><a href="<?= $item['link']; ?>"><?= $item['label']; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>

                                </td>
                                <td></td>
                            </tr>
                        </table>


                    </td>

                </tr>
            </table>

        </td>
    </tr>


</table>
</body>
</html>