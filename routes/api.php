<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/edit/user','UserController@edit');
Route::middleware('auth:sanctum')->post('/edit/user','UserController@update');
Route::middleware('auth:sanctum')->post('/edit/password/user','UserController@passwordUpdate');

Route::get('/email-verification', 'VerificationController@verify')->name('verification.verify');
Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');
Route::post('/logout', 'LoginController@logout');

Route::post('/forgot-password', 'ForgotPasswordController@sendResetLinkEmail')->name('forgot-password');
Route::post('/reset-password', 'ResetPasswordController@reset')->name('reset-password');

Route::post('/payment/{price}', 'PaymentController@preparePayment');
Route::post('/webhook', 'PaymentController@handleWebhookNotification');


Route::middleware('auth:sanctum')->post('/reservations', 'ReservationController@create');
Route::middleware('auth:sanctum')->get('/reservations', 'ReservationController@showByUser');
Route::middleware('auth:sanctum')->get('/reservation/{orderID}', 'ReservationController@showByReservation');

Route::middleware('auth:sanctum')->get('/allReservations', 'ReservationController@index');
Route::middleware('auth:sanctum')->get('/reservations/{reservation}', 'ReservationController@show');

