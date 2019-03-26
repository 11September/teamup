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

Auth::routes();

Route::get('/', 'WelcomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['middleware' => 'auth'], function () {

            Route::middleware(['admin'])->group(function () {

                Route::get('/', 'AdminController@admin')->name('home');

                Route::get('/users/reset_password/{user}', 'UsersController@reset_password')->name('reset_user_password');
                Route::post('/users/update_password/{id}', 'UsersController@update_password')->name('update_user_password');
                Route::resource('users', 'UsersController');

                Route::resource('activities', 'ActivitiesController')->only([
                    'index', 'store', 'update', 'destroy'
                ]);

                Route::prefix('teams')->group(function () {

                });

                Route::resource('settings', 'SettingsController')->only([
                    'index', 'store'
                ]);

                Route::resource('feedbacks', 'FeedbacksController')->only([
                    'index', 'update', 'destroy'
                ]);
            });

            Route::middleware(['adminOrCoach'])->group(function () {

            });

        });
    });
});
