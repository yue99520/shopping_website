require('./bootstrap');

$(document).ready(function () {
    $('.ui.dropdown')
        .dropdown()
    ;

    $('#logout_button').click(function () {
        let csrfToken = $('#csrf').text();
        let root = $('meta[name="url"]').attr('content');
        fetch( root + '/logout', {
            method: 'POST',
            headers: {
                'X-CSRF_TOKEN': csrfToken.trim()
            }
        }).then(function () {
            window.location = root
        });
    });
});
