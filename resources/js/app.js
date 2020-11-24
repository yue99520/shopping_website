require('./bootstrap');

function showErrorMessage(message_id, header, content) {
    let message = $('#' + message_id + '.ui.negative.message');
    message.find('div').text(header);
    message.find('p').text(content);
    message.removeAttr('hidden');
}

function getFormFieldValue(field_id) {
    //semantic ui api
    return $('.ui.form').form('get field', field_id).val();
}

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

    $("#login_form").submit(function(e) {
        e.preventDefault();
        let csrfToken = $('input[name="_token"]').attr('value');
        let email = getFormFieldValue('email');
        let password = getFormFieldValue('password');
        let root = $('meta[name="url"]').attr('content');
        fetch(root + '/login', {
            method: 'POST',
            body: JSON.stringify({
                'email': email,
                'password': password,
            }),
            headers: {
                'X-CSRF_TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        }).then(function (response) {
            if (response.status === 204) {
                window.location = root;
            } else if (response.status === 422){
                showErrorMessage(
                    'login_error',
                    'Login fail',
                    'Invalid email or password.')
            }
        });
    });

    $("#register_form").submit(function(e) {
        e.preventDefault();
        let csrfToken = $('input[name="_token"]').attr('value');
        let name = getFormFieldValue('name');
        let email = getFormFieldValue('email');
        let password = getFormFieldValue('password');
        let password_confirmation = getFormFieldValue('password_confirmation');
        let root = $('meta[name="url"]').attr('content');
        fetch(root + '/login', {
            method: 'POST',
            body: JSON.stringify({
                'name': name,
                'email': email,
                'password': password,
                'password_confirmation': password_confirmation,
            }),
            headers: {
                'X-CSRF_TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        }).then(function (response) {
            if (response.status === 204) {
                window.location = root;
            } else if (response.status === 422){
                showErrorMessage(
                    'register_error',
                    'Register fail',
                    'Invalid input content.')
            }
        });
    });
});
