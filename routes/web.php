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
})->middleware('verified');
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Auth::routes(['verify' => true]);
Route::get('/otpSend', 'HomeController@otpSend')->name('otpSend')->middleware('verified');
Route::post('/verify/phoneNumber', 'HomeController@phoneNumber')->name('phoneNumber')->middleware('verified');
