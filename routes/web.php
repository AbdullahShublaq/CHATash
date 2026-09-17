<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeysController;
use App\Http\Controllers\PrivateRoomController;
use App\Http\Controllers\PrivateRoomMessagesController;
use App\Http\Controllers\PublicRoomController;
use App\Http\Controllers\PublicRoomMessagesController;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:10,1');

//Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
//Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
//Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm']);

Route::group(['middleware' => ['auth', 'throttle:60,1']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('/public', PublicRoomController::class)->only('index');
    Route::resource('/public/messages', PublicRoomMessagesController::class)->only('index', 'store', 'destroy');
    Route::get('/public/roomkey', [KeysController::class, 'publicRoomKey']);

    Route::post('/keys/publish', [KeysController::class, 'publish']);
    Route::get('/keys/directory', [KeysController::class, 'directory']);

    Route::resource('/private/messages', PrivateRoomMessagesController::class)->only('index', 'store', 'destroy');
    Route::resource('/private', PrivateRoomController::class)->only('index', 'show', 'store');
    Route::post('/private/addParticipant', [PrivateRoomController::class, 'addParticipant']);
});