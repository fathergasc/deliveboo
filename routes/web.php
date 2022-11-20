<?php

use Illuminate\Support\Facades\Route;

// authentication routes
Auth::routes();

Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/checkAuth', 'HomeController@checkAuth');
    Route::resource('products', 'ProductController');
    Route::resource('orders', 'OrderController');
    Route::resource('restaurants', 'RestaurantController');

    Route::delete('products/deleteProductImage/{product}', 'ProductController@deleteProductImage' )->name('products.deleteProductImage');
});

// vue
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
