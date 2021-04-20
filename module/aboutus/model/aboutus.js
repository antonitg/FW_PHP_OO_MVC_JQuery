function sendEmail(content) {
    friendlyURL('?page=aboutus&op=sendEmail')
    .then(function(data) {
        ajaxPromise(data, 'POST', 'JSON', content)
        .then(function(data) {
            console.log(data);
            // toastr.success('Email sended');
            // $('#send-email-form').trigger('reset');
        }).catch(function(error) {
            // toastr.error('Something happend when trying to send.' ,'Error');
            console.log(error);
        });
    });
}
$(document).ready(function() {
    $(document).on('click', '#send-email', function () {
        sendEmail({name: $('#contact-name').val(), email: $('#contact-email').val(), matter: $('#contact-matter').val() ,message: $('#message').val()});
    });
});
