<div class="wrap">
    <div class="row">

        <div class="col-sm-4">
                <div class="custom-calendar-wrap">
                    <div id="custom-inner" class="custom-inner">
                        <div class="custom-header clearfix">
                            <nav>
                                <span id="custom-prev" class="custom-prev"></span>
                                <span id="custom-next" class="custom-next"></span>
                            </nav>
                            <h2 id="custom-month" class="custom-month"></h2>
                            <h3 id="custom-year" class="custom-year"></h3>
                        </div>
                        <div id="calendar" class="fc-calendar-container"></div>
                    </div>
                </div>
        </div>

        <div class="col-sm-4">

            <div class="step-2">
                <h4><?= __('Choose a room:','bkng'); ?></h4>
                <select class="form-control choose-room">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                    <option selected="selected" disabled value="0">Choose a room</option>
                </select>
            </div>


            <div class="step-3">
                <div class="custom-calendar-wrap">
                    <div id="custom-inner" class="custom-inner">
                        <div class="custom-header clearfix">
                            <h2 id="custom-month" class="custom-month">Choose time</h2>
                        </div>
                        <div id="calendar-time" class="fc-calendar-container time-calendar">
                            <div class="fc-calendar fc-five-rows">
                                <div class="fc-body calendar-time-body">
                                    <div class="fc-row">

                                        <div class="cell-time" data-date-attr="4/2/2019"><span class="fc-date">4:30</span></div>
                                        <div class="cell-time" data-date-attr="5/2/2019"><span class="fc-date">5:50</span></div>
                                        <div class="cell-time" data-date-attr="5/2/2019"><span class="fc-date">5:50</span></div>
                                        <div class="cell-time" data-date-attr="5/2/2019"><span class="fc-date">5:50</span></div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-sm-4">

            <div class="step-4">
                <h4><?= __('Booking details:','bkng'); ?></h4>

                <form action="" method="post" >
                <table class="table table-striped w-auto booking-table-edit">
                    <tbody>
                        <tr>
                            <td><label><?= __('Name','bkng'); ?></label></td>
                            <td>
                                <input name="booking_id" id="booking_id"  type="hidden" value="" class="form-control" />
                                <input id="name_booking" name="name_booking" placeholder="<?= __('Name...','bkng'); ?>" type="text" value="" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('E-mail','bkng'); ?></label></td>
                            <td>
                                <input name="email_booking" id="email_booking" placeholder="<?= __('Email...','bkng'); ?>" type="email" value="" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Phone','bkng'); ?></label></td>
                            <td>
                                <input name="phone_booking" id="phone_booking"  placeholder="<?= __('Phone...','bkng'); ?>" type="text" value="" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Price & Quantity','bkng'); ?></label></td>
                            <td>
                                <select name="price_booking" id="price_booking"  class="form-control">
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Discount','bkng'); ?></label></td>
                            <td>
                                <input name="discount_booking" id="discount_booking"  placeholder="<?= __('Discount...','bkng'); ?>" type="text" value="" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label><?= __('Notes','bkng'); ?></label></td>
                            <td>
                                <textarea name="notes_booking" id="notes_booking" placeholder="<?= __('Your comments...','bkng'); ?>" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-success edit-button " type="button"><?= __('Edit','bkng'); ?></button>
                                <button name="save_booking" style="display:none;" class="btn btn-primary save-button" type="submit"><?= __('Save','bkng'); ?></button>
                            </td>
                            <td>
                                <button class="btn btn-danger delete-button" type="button"><?= __('Delete','bkng'); ?></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>

            </div>
        </div>


    </div>
</div>



<div class="loading"><img src="<?= plugin_dir_url(__DIR__); ?>/calendar/img/spinner.svg"></div>

<style>

    body{background: #f1f1f1}

    .fc-calendar .fc-row > div.cell-time.reserved {
        background: #ccc;
    }

    .step-2, .step-3, .step-4{
        display: none;
    }

    select.form-control {
        height: 38px;
        font-size: 15px;
        margin: 18px 0;
    }

    .fc-calendar .fc-row > div.cell-time{
        float: left;
        height: 100%;
        width: -moz-calc(100%/4);
        width: -webkit-calc(100%/4);
        width: calc(100%/4);
        position: relative;
    }

    .fc-calendar-container.time-calendar{
        height: auto;
    }

    .fc-calendar-container.time-calendar .fc-row{
        height: 32px;
    }

    .fc-calendar-container.time-calendar .fc-body{
        height: auto;
    }

    .fc-calendar .fc-row > div.cell-time > span.fc-date{
        margin: -10px 0 0 -25px;
    }

    .fc-calendar .fc-row  .selected-day, .fc-calendar .fc-row > div.fc-today.selected-day{
        background: #201186ba !important;
    }

    .fc-calendar .fc-row > div.selected-day > span.fc-date {
        color: #fff;
        text-shadow: 0 1px 1px rgba(0,0,0,0.1);
    }






    .loading img{
        position: inherit;
        width: 140px;
        top: 30%
    }

    /* Absolute Center Spinner */
    .loading {
        display: none;
        position: fixed;
        z-index: 999;
        height: 2em;
        width: 2em;
        overflow: visible;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    /* Transparent Overlay */
    .loading:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.3);
    }

    /* :not(:required) hides these rules from IE9 and below */
    .loading:not(:required) {
        /* hide "loading..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }


    /* Animation */

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

</style>







