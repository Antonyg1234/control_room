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

Route::get('/', function () {
    return view('welcome');
});

Route::post('forgot-password', 'PasswordController@checkVerifiedEmail');
Route::get('forgot/password/{id}', 'PasswordController@resetPasswordLink')->name('reset_password_link');
Route::post('update-password', 'PasswordController@updatePassword')->name('update_password');
