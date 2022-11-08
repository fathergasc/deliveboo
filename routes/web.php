<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// authentication
Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
});

// vue
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');