<?php

use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Create Dingo Router
$api = app(Router::class);

// Create a Dingo Version Group
$api->version('v1', ['middleware' => 'api'], function ($api) {
    $api->group(['prefix' => 'auth'], function ($api) {
        $api->post('register', [
            'as' => 'register',
            'uses' => 'App\\Api\\V1\\Controllers\\RegisterController@register',
        ]);

        $api->post('login', [
            'as' => 'login',
            'uses' => 'Laravel\\Passport\\Http\\Controllers\\AccessTokenController@issueToken',
        ]);

        $api->get('logout', [
            'middleware' => 'auth:api',
            'as' => 'logout',
            'uses' => 'App\\Api\\V1\\Controllers\\LogoutController@logout',
        ]);

        $api->post('recovery', [
            'as' => 'password.email',
            'uses' => 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail',
        ]);
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
    });

    // Protected routes
    $api->group(['middleware' => 'auth:api'], function ($api) {
        $api->get('protected', function () {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.',
            ]);
        });

        $api->get('users', [
            'as' => 'users.index',
            'uses' => 'App\\Api\\V1\\Controllers\\UserController@index',
        ]);

        $api->get('users/{user}', [
            'as' => 'users.show',
            'uses' => 'App\\Api\\V1\\Controllers\\UserController@show',
        ]);

        $api->post('addHall', [
            'as' => 'admin.addHall',
            'uses' => 'App\\Http\\Controllers\\AdminController@addHall',
        ]);

        $api->post('deleteHall', [
            'as' => 'admin.deleteHall',
            'uses' => 'App\\Http\\Controllers\\AdminController@deleteHall',
        ]);

        $api->post('getHall', [
            'as' => 'admin.getHall',
            'uses' => 'App\\Http\\Controllers\\AdminController@getHall',
        ]);

        $api->post('updateHall', [
            'as' => 'admin.updateHall',
            'uses' => 'App\\Http\\Controllers\\AdminController@updateHall',
        ]);

        $api->post('updatePrices', [
            'as' => 'admin.updatePrices',
            'uses' => 'App\\Http\\Controllers\\AdminController@updatePrices',
        ]);

        $api->post('addFilm', [
            'as' => 'admin.addFilm',
            'uses' => 'App\\Http\\Controllers\\AdminController@addFilm',
        ]);

        $api->post('deleteFilm', [
            'as' => 'admin.deleteFilm',
            'uses' => 'App\\Http\\Controllers\\AdminController@deleteFilm',
        ]);

        $api->post('addSeance', [
            'as' => 'admin.addSeance',
            'uses' => 'App\\Http\\Controllers\\AdminController@addSeance',
        ]);

        $api->post('deleteSeance', [
            'as' => 'admin.deleteSeance',
            'uses' => 'App\\Http\\Controllers\\AdminController@deleteSeance',
        ]);
        
        $api->post('getSeances', [
            'as' => 'admin.getSeances',
            'uses' => 'App\\Http\\Controllers\\AdminController@getSeances',
        ]);
        
    });
});
