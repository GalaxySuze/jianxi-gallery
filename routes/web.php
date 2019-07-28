<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Home', 'middleware' => 'auth'], function () {

    Route::get('/', 'IndexController@index')->name('home.index');
    Route::get('/detail/{id}', 'IndexController@detail')->name('home.detail');


    Route::get('/not-open', 'IndexController@notOpen')->name('home.not-open');


});


Auth::routes();
