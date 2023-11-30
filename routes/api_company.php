<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/ttt', function () {
    app()->setLocale('fr');
    $locale = app()->getLocale();
    return $locale;;
});



Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/confirm-login', 'AuthController@confirmCode');

Route::middleware('CompanyAuthMiddleware:company')->group(function () {
    Route::post('/me', 'AuthController@me');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/hello', 'AuthController@sayHello');


    Route::group(['prefix' => 'deals' , 'namespace'=> 'Deals'], function () {
        Route::get('/', 'DealsController@getCompanyDeals');
        Route::post('/create', 'DealsController@create');
    });
});





Route::fallback(function () {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route'
    ]);
});
