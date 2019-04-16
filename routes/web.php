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
        Route::middleware(['auth', 'canAdmin', 'active', 'activationPeriod'])->group(function () {

            Route::get('/', 'AdminController@admin')->name('admin');

            Route::group(['as' => 'user.'], function () {
                Route::get('/users/reset_password/{user}', 'UsersController@reset_password')->name('reset_user_password');
                Route::post('/users/update_password/{id}', 'UsersController@update_password')->name('update_user_password');
                Route::resource('users', 'UsersController');
            });

            Route::middleware(['canAdmin'])->group(function () {
                Route::group(['as' => 'team.'], function () {
                    Route::resource('teams', 'TeamsController')->except([
                        'show'
                    ]);
                });

                Route::group(['as' => 'reports.'], function () {
                    Route::resource('reports', 'ReportsController')->except([
                        'show'
                    ]);
                });

                Route::group(['as' => 'activity.'], function () {
                    Route::resource('activities', 'ActivitiesController')->except([
                        'show'
                    ]);
                });
            });


            Route::middleware(['admin'])->group(function () {
                Route::group(['as' => 'measure.'], function () {
                    Route::resource('measures', 'MeasuresController')->only([
                        'index', 'store', 'destroy'
                    ]);
                });

                Route::group(['as' => 'setting.'], function () {
                    Route::resource('settings', 'SettingsController')->only([
                        'index', 'store'
                    ]);
                });

                Route::group(['as' => 'feedback.'], function () {
                    Route::resource('feedbacks', 'FeedbacksController')->only([
                        'index', 'update', 'destroy'
                    ]);
                });
            });


            Route::middleware(['coach'])->group(function () {
                Route::group(['as' => 'notes.'], function () {
                    Route::resource('notes', 'NotesController')->except([
                        'show'
                    ]);
                });
            });

        });
    });
});
