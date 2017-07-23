<?php

// Route::resource('/', 'HomeController');
// Route::resource('/home', 'HomeController');

Route::group(['middleware' => ['auth']], function(){
	Route::any('dashboard', 'DashboardController@index');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('home', function() {
	return Redirect::to('dashboard');
});

Route::get('/', function() {
	return Redirect::to('dashboard');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
