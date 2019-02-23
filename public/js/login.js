$(document).ready(function() {
    $('.login-form > .conf-step__button').on('click', function(event) {
        event.preventDefault();
        var grantType = 'password';
        var clientId = $('.login-form > input:eq(0)').val();
        var clientSecret = $('.login-form > input:eq(1)').val();
        var userName = $('.login-form > input:eq(2)').val();
        $.post('/api/auth/login', {
            'grant_type': grantType,
            'client_id': clientId,
            'client_secret': clientSecret,
            'username': userName,
            'password': $('.login-form > input:eq(3)').val()
        }).done(function(data) {
            console.dir(data);
            if (data.token_type) console.log(true + data.token_type);
            localStorage.setItem('access_token', data.access_token);
            localStorage.setItem('token_type', data.token_type);
            localStorage.setItem('user', userName);
            location.href = '/admin';
        }).fail(function() {
            console.log(false);
            $('.login-form > input').css('outline', '1px solid #F4645F');
            $('.login-form .error-alert').addClass('error-off');
        });
    });
});