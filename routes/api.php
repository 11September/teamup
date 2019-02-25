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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('cors')->post('login', 'API\UserController@login');
Route::middleware('cors')->post('register', 'API\UserController@register');
Route::middleware('cors')->post('restore_password', 'UsersController@ResetPassword');
Route::middleware('cors')->get('settings/{privacy}', 'API\SettingsController@privacy_policy');

//Route::group(['middleware' => 'auth:api'], function(){
//    Route::post('details', 'API\UserController@details');
//});


Route::group(['middleware' => ['auth:api', 'cors']], function () {
    Route::get('settings/{expired}', 'API\SettingsController@expired');
    Route::get('feedbacks', 'API\FeedbacksController@expired');

    Route::post('change_password', 'UsersController@ChangePassword')->name('Change Password');
    Route::post('set_avatar', 'UsersController@SetAvatar')->name('Set Avatar');
    Route::post('set_player', 'UsersController@SetPlayer')->name('Set User Player ID');
    Route::post('set_push', 'UsersController@SetPush')->name('Set Push');


    Route::post('details', 'API\UserController@details');

    Route::resource('notes', 'API\NotesController')->except([
        'create', 'show', 'edit'
    ]);
});
