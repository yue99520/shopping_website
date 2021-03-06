require('./bootstrap');

function showErrorMessage(message_id, header, content) {
    let message = $('#' + message_id + '.ui.negative.message');
    message.find('div').text(header);
    message.find('p').text(content);
    message.removeAttr('hidden');
}

function getFormImageInputUrl(name) {
    let url = $('input[name="' + name + '"]').data('image');
    return (url === undefined || url === null || url.length === 0) ? null : url;
}

function setFormImageInputUrl(name, url) {
    $('input[name="' + name + '"]').data('image', url);
}

function getFormFieldValue(name) {
    //semantic ui api
    return $('.ui.form').form('get field', name).val();
}

function getRootDomain() {
    return $('meta[name="url"]').attr('content');
}

function getFormCsrf() {
    return $('input[name="_token"]').attr('value');
}

function getAppBarCsrf() {
    return $('#csrf').text();
}

$(document).ready(function () {
    $('.ui.dropdown')
        .dropdown()
    ;

    $('.activating.element')
        .popup({
            on: 'click'
        })
    ;

    $('#edit_shop_button').click(function () {
        let root = getRootDomain();
        let shop = $('#edit_shop_button').data('shop');
        window.location = root + '/shop/' + shop + '/edit';
    });

    $('#logout_button').click(function () {
        let csrfToken = getAppBarCsrf();
        let root = getRootDomain();
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
        let csrfToken = getFormCsrf();
        let email = getFormFieldValue('email');
        let password = getFormFieldValue('password');
        let root = getRootDomain();
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
        let csrfToken = getFormCsrf();
        let name = getFormFieldValue('name');
        let email = getFormFieldValue('email');
        let password = getFormFieldValue('password');
        let password_confirmation = getFormFieldValue('password_confirmation');
        let root = getRootDomain();

        fetch(root + '/register', {
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
            if (response.status === 201) {
                window.location = root;
            } else if (response.status === 422){
                showErrorMessage(
                    'register_error',
                    'Register fail',
                    'Invalid input content.')
            }
        });
    });

    $("#shop_edit_form").submit(function (e) {
        e.preventDefault();
        let csrfToken = getFormCsrf();
        let shop = $('input[name="shop_id"]').attr('value');
        let title = getFormFieldValue('title');
        let description = getFormFieldValue('description');
        let image = getFormImageInputUrl('image');
        let root = getRootDomain();

        fetch(root + '/shop/' + shop, {
            method: 'PATCH',
            body: JSON.stringify({
                'title': title,
                'description': description,
                'image': image,
            }),
            headers: {
                'X-CSRF_TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        }).then(function (response) {
            if (response.status === 200) {
                window.location = root + '/shop/dashboard';
            } else if (response.status === 422){
                showErrorMessage(
                    'edit_shop_error',
                    'Update fail',
                    'Invalid input content.')
            }
        });
    });

    $("#shop_create_form").submit(function (e) {
        e.preventDefault();
        let csrfToken = getFormCsrf();
        let title = getFormFieldValue('title');
        let description = getFormFieldValue('description');
        let image = getFormImageInputUrl('image');
        let root = getRootDomain();

        fetch(root + '/shop', {
            method: 'POST',
            body: JSON.stringify({
                'title': title,
                'description': description,
                'image': image,
            }),
            headers: {
                'X-CSRF_TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        }).then(function (response) {
            if (response.status === 200) {
                window.location = root + '/shop/dashboard';
            } else if (response.status === 422){
                showErrorMessage(
                    'shop_create_error',
                    'Create fail',
                    'Invalid input content.')
            }
        });
    });

    $('#image_input').change(function (event) {
        let csrfToken = getFormCsrf();
        let root = getRootDomain();
        const file = event.target.files[0];

        if (!file) {
            return;
        }

        const formData = new FormData();
        formData.append('image', file)

        fetch(root + '/image', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF_TOKEN': csrfToken,
                'Accept': 'application/json',
            }
        })
            .then(response => {
                return response.json()
            })
            .then(data => {
                let url = '/storage' + data.url;
                console.log(url)
                $('#image_input_preview').attr('src', url);
                setFormImageInputUrl('image', url)
            })
            .catch(error => {
                console.log(error)
            })
    });
});
