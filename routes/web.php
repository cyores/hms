<?php

Route::group(['middleware' => ['auth']], function(){
	Route::any('dashboard', 'DashboardController@index');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
