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
    Route::resource('/products', 'ProductController');
});

// vue
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');