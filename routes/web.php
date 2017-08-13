<?php

// Route::resource('/', 'HomeController');
// Route::resource('/home', 'HomeController');

Route::group(['middleware' => ['auth']], function(){
	// Dashbaord routes
	Route::post('dashboard/newevent', 'DashboardController@postNewEvent');
	Route::any('dashboard', 'DashboardController@index');

	// Movies routes
	Route::post('movies/search', 'MoviesController@postSearch');
	Route::post('movies/scan', 'MoviesController@postScan');
	Route::any('movies/{id}', 'MoviesController@anyWatchMovie');
	Route::any('movies', 'MoviesController@index');

	// TV Shows routes
	Route::any('tv', 'TVController@index');

	// Account routes
	Route::any('account', 'AccountController@index');

	// Files routes
	Route::post('files/upload', 'FileController@postUploadFiles');
	Route::post('files/delete', 'FileController@postDelete');
	Route::post('files/newfolder', 'FileController@postNewFolder');
	Route::any('files/{path}', 'FileController@anyOpenFolder')->where('path', '(.*)');
	Route::any('files', 'FileController@index');

	// Pictures routes
	Route::any('pictures', 'PictureController@index');

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

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
