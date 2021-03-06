<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/public', 'PublicRoomController')->only('index');
    Route::resource('/public/messages', 'PublicRoomMessagesController')->only('index', 'store');

    Route::resource('/private/messages', 'PrivateRoomMessagesController')->only('index', 'store');
    Route::resource('/private', 'PrivateRoomController')->only('index', 'show', 'store');
    Route::post('/private/addParticipant', 'PrivateRoomController@addParticipant');
});

