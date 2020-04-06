<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');
Route::post('forgot-password', 'API\PasswordController@checkVerifiedEmail');
Route::get('forgot/password/{id}', 'API\PasswordController@resetPasswordLink')->name('reset_password_link');
Route::post('update-password', 'API\PasswordController@updatePassword')->name('update_password');

Route::middleware('auth:api')->namespace('API')->group( function () {
    Route::post('logout','RegisterController@logout');
    Route::resource('products', 'ProductController');
    Route::get('calls', 'RecordCallController@index');
    Route::post('change-password', 'UserController@changePassword');
});
