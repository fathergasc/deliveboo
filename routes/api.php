<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('restaurants', 'Api\RestaurantController@index');
Route::get('restaurants/{restaurant}','Api\RestaurantController@show');
Route::get('cuisines', 'Api\CuisineController@index');
Route::post('order', 'Api\OrderController@orderHandle');
