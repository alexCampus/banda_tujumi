<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/presentation', function() {
	return view('about');
});

Route::get('/actualites', 'NewsController@index');
Route::get('/createNews', 'NewsController@create');
Route::post('/createNews', 'NewsController@store');

Route::get('/medias', function() {
	return view('medias');
});

Route::get('/agenda', 'EventController@index');

Route::get('/contact', function() {
	return view('contact');
});
//Route::get('/home', 'HomeController@index')->name('home');
