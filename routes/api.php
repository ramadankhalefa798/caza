<?php

use App\Models\Admin;
use App\Models\DealType;
use Illuminate\Support\Facades\Route;

Route::get('/ttt', function () {
    app()->setLocale('en');
    $locale = app()->getLocale();
    return $locale;;
});

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/confirm-login', 'AuthController@confirmCode');
Route::get('/estates/types', 'HomeController@getEstatesTypes');
Route::get('/professions', 'HomeController@getProfessions');

Route::middleware('UserAuthMiddleware:api')->group(function () {
    Route::post('/me', 'AuthController@me');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/hello', 'AuthController@sayHello');
});


Route::fallback(function () {
    return response()->json([
        'result' => false,
        'errNum' => 404,
        'message' => 'Invalid Route'
    ]);
});
