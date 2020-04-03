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
Route::post('forgot-password', 'API\RegisterController@checkVerifiedEmail');
Route::get('forgot-password/{id}', 'API\RegisterController@resetPasswordLink')->name('reset_password_link');
Route::post('update-password', 'API\RegisterController@updatePassword')->name('update_password');

Route::middleware('auth:api')->group( function () {
    Route::resource('products', 'API\ProductController');
    Route::post('change-password', 'API\UserController@changePassword');
});
