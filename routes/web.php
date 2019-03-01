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

                Route::resource('users', 'UsersController');

                Route::prefix('teams')->group(function () {

                });

            });

            Route::middleware(['adminOrCoach'])->group(function () {

            });

        });
    });
});
