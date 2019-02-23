<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'AdminController@getClient');

Route::get('/admin', 'AdminController@showAdminPanel');

Route::get('/reception/findTicket', 'AdminController@findTicket');

Route::get('/reception', 'AdminController@showReceptionPanel');

Route::get('/', 'ClientController@showMainClient');
Route::get('/client', 'ClientController@showMainClient');

Route::get('/client/hall', 'ClientController@showHallClient');

Route::post('/client/addTicket', 'ClientController@addTicket');

Route::get('/client/getReservedChars', 'ClientController@getReservedChars');

Route::get('/client/payment', 'ClientController@showTicketClient');

Route::post('/client/addQrCode', 'ClientController@addQrCode');

