<?php

// Route::resource('/', 'HomeController');
// Route::resource('/home', 'HomeController');

Route::group(['middleware' => ['auth']], function(){
	// Dashbaord routes
	Route::post('dashboard/newevent', 'DashboardController@postNewEvent');
	Route::any('dashboard', 'DashboardController@index');

	// Account routes
	Route::any('account', 'AccountController@index');

	// Files routes
	Route::post('files/upload', 'FileController@postUploadFiles');
	Route::post('files/delete', 'FileController@postDelete');
	Route::post('files/newfolder', 'FileController@postNewFolder');

	Route::any('files/{path?}', 'FileController@anyOpenFolder')->where('path', '(.*)');
	
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
