<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


    Route::group(['namespace' => 'Dashboard', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');
    });




    Route::group(['namespace' => 'Dashboard', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {

        Route::get('/login', function () {
            // return view('dashboard.auth.login');
            return "admin login";
        })->name('admin.login');

        Route::post('login', 'LoginController@postLogin')->name('admin.post.login');
    });
});
