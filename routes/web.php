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

	// Locker routes
	Route::post('locker/edit/applychanges', 'LockerController@postApplyChanges');
	Route::any('locker/edit/{entry_id}', 'LockerController@anyEditIndex');
	Route::post('locker/delete', 'LockerController@postDelete');
	Route::post('locker/search', 'LockerController@postSearch');
	Route::post('locker/newentry', 'LockerController@postNewEntry');
	Route::any('locker', 'LockerController@index');

});

// Special Movies and TV Redirects
Route::get('tv/blacksails', function(){ return Redirect::to('tv/1'); });
Route::get('tv/davinci', function(){ return Redirect::to('tv/2'); });
Route::get('tv/got', function(){ return Redirect::to('tv/3'); });
Route::get('tv/spartacus', function(){ return Redirect::to('tv/4'); });
Route::get('tv/vikings', function(){ return Redirect::to('tv/5'); });

// TV Shows routes
Route::any('tv/watch/{epis_id}', 'TVController@anyWatchEpisode');
Route::any('tv/{show_id}/{sezn_id}', 'TVController@anySeason');
Route::any('tv/{show_id}', 'TVController@anyShow');
Route::any('tv', 'TVController@index');

// Movies routes
Route::post('movies/search', 'MoviesController@postSearch');
Route::post('movies/scan', 'MoviesController@postScan');
Route::any('movies/{id}', 'MoviesController@anyWatchMovie');
Route::any('movies', 'MoviesController@index');

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
