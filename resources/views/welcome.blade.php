<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/normalize.css">
    <link rel="stylesheet" href="CSS/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <title>GO2Cinema</title>
</head>
<script>
    if(localStorage.getItem('access_token')) {
        location.href = '/admin';
    }
    </script>
<body>
    <div class="container">
        <header class="page-header login-page">
            <h1 class="page-header__title">Идём<span>в</span>кино</h1>
        </header>
        <main class="conf-steps login-form-container">
            <form class="login-form">
            @if (isset($client->id))
                <input type="hidden" value="{{$client->id}}">
                <input type="hidden" value="{{$client->secret}}">
            @endif
                <input type="email" class="conf-step__input" placeholder="Введите email">
                <input type="password" class="conf-step__input" placeholder="Введите пароль">
                <button type="submit" class="conf-step__button conf-step__button-accent">Авторизоваться</button>
                <p class="error-alert">Ошибка авторизации. <br> Проверьте правильность <br> ввода логина или пароля <br> и повторите попытку.</p>
            </form>
        </main>
    </div>
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
