<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Home',], function () {

    Route::get('/', 'IndexController@index')->name('home.index');

    Route::get('/not-open', 'IndexController@notOpen')->name('home.not-open');

    Route::get('/detail/{id}', 'IndexController@detail')->name('home.detail');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
