<h1 align="center">
Laravel API Boilerplate (Vagrant, Passport)
</h1>


Стартовый набор для быстрого запуска API

Сборка содержит в себе:
* Laravel Passport - [laravel/passport](https://github.com/laravel/passport)
* Dingo API - [dingo/api](https://github.com/dingo/api) <a href="https://github.com/dingo/api/wiki/Creating-API-Endpoints" target="_blank">(информация)</a>
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors) <a href="https://github.com/barryvdh/laravel-cors" target="_blank">(читать тут)</a>

## Vagrant
### Установить
* [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
* [Vagrant](https://www.vagrantup.com/downloads.html)

### Склонировать репозиторий
```
git clone https://github.com/seregka-che/laravel-vagrant-passport
```
### Поднять локальный сервер на Vagrant
```
vagrant up
```
### Предустановленные роуты
Зарегистрировать нового пользователя и сегенерировать для него пароль можно используя командную строку
`php artisan passport:client --password`.

* `POST api/auth/login`, Авторизация и обновление токена;
* `POST api/auth/register`, Регистрация;
* `POST api/auth/recovery`, Восстановление пароля;
* `POST api/auth/reset`, Сброс пароля;
* `POST api/auth/logout`, "выход" - стереть данные по токену авторизации ;

### Сгенерировать ключи
```
php artisan passport:keys
```

