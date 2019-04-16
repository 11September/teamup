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

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'AuthController@register')->name('register');

        Route::post('feedback', 'FeedbacksController@loginFeedback')->name('login_feedback');

        Route::post('recovery_password', 'AuthController@recovery_password')->name('recovery_password');
        Route::post('confirm_code', 'AuthController@confirm_code')->name('confirm_code');
        Route::post('reset_password', 'AuthController@reset_password')->name('reset_password');

    });

    Route::middleware(['cors', 'auth:api'])->group(function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('details', 'UsersController@details')->name('user_details');
            Route::post('change_password', 'UsersController@ChangePassword')->name('change_pass');
            Route::post('set_code_team', 'UsersController@SetCodeTeam')->name('set_code_team');
            Route::post('set_activation_code', 'UsersController@SetActivationCode')->name('set_activation_code');
            Route::post('set_avatar', 'UsersController@SetAvatar')->name('set_avatar');
            Route::post('set_player', 'UsersController@SetPlayer')->name('set_user_player_id');
            Route::post('set_push', 'UsersController@SetPush')->name('set_push');
            Route::post('set_push_chat', 'UsersController@SetPushChat')->name('set_push_chat');
            Route::post('logout', 'AuthController@logout')->name('logout');
        });

        Route::group(['prefix' => 'notes'], function () {
            Route::delete('delete', 'NotesController@destroy')->name('notes_delete');
            Route::resource('notes', 'NotesController')->only([
                'index', 'store', 'update', 'destroy'
            ]);
        });

        Route::group(['prefix' => 'activities'], function () {
            Route::resource('activities', 'ActivitiesController')->only([
                'index', 'create' ,'store', 'edit' ,'update'
            ]);
        });

        Route::group(['prefix' => 'records'], function () {
            Route::resource('records', 'RecordsController')->only([
                'index', 'store', 'update'
            ]);
        });

    });
});
