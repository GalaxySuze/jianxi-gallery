<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Home',], function () {

    Route::get('/', 'IndexController@index')->name('home.index');

    Route::get('/not-open', 'IndexController@notOpen')->name('home.not-open');

    Route::get('/detail/{id}', 'IndexController@detail')->name('home.detail');

    Route::get('/login', 'IndexController@login')->name('home.login');

});

