jQuery( document ).ready(function() {
    jQuery(".dashboard-form-del").on("submit", function (event) {
        if (!confirm(bkng_messages.message_confirm_before_delete_booking)) {
            event.preventDefault();
        }
    });
});