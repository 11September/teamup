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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('App')->group(function () {
    Route::middleware(['cors'])->group(function () {

        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'AuthController@register')->name('register');

    });

    Route::middleware(['cors', 'auth:api'])->group(function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('details', 'UsersController@details')->name('user_details');
            Route::post('change_password', 'UsersController@ChangePassword')->name('change_pass');
            Route::post('set_avatar', 'UsersController@SetAvatar')->name('set_avatar');
            Route::post('set_player', 'UsersController@SetPlayer')->name('set_user_player_id');
            Route::post('set_push', 'UsersController@SetPush')->name('set_push');
            Route::post('set_push_chat', 'UsersController@SetPushChat')->name('set_push_chat');
            Route::post('logout', 'AuthController@logout')->name('logout');
        });
    });
});
