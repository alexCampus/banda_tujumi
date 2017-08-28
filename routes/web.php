<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/presentation', function() {
	return view('about', array('imageUrl' => 'img/Tujumi.jpg'));
});

Route::get('/actualites', 'NewsController@index');
Route::get('/createNews', 'NewsController@create')->middleware('auth');
Route::post('/createNews', 'NewsController@store')->middleware('auth');
Route::get('/updateNews/{id}', 'NewsController@viewUpdate')->where('id', '[0-9]+')->middleware('auth');
Route::post('/updateNews/{id}', 'NewsController@update')->where('id', '[0-9]+')->middleware('auth');

Route::get('/medias', function() {
	return view('medias', array('imageUrl' => 'img/galerie-grp.jpg'));
});

Route::get('/agenda', 'EventController@index');
Route::get('/agenda/{id}', 'EventController@show')->where('id', '[0-9]+');
Route::get('/createEvent', 'EventController@formCreate')->middleware('auth');
Route::post('/createEvent', 'EventController@store')->middleware('auth');
Route::post('/{id}/participe', 'EventController@participe')->where('id', '[0-9]+')->middleware('auth');
Route::post('/{id}/desinscription', 'EventController@desinscription')->where('id', '[0-9]+')->middleware('auth');
Route::get('/updateEvent/{id}', 'EventController@updateView')->where('id', '[0-9]+')->middleware('auth');
Route::post('/updateEvent/{id}', 'EventController@update')->where('id', '[0-9]+')->middleware('auth');

Route::get('/contact', function() {
	return view('contact', array('imageUrl' => 'img/contact.JPG'));
});

Route::get('/adminUser', 'AdminController@index')->middleware('auth');
Route::get('/upGradeAdminLevel', 'AdminController@upGradeAdminLevel')->middleware('auth');
Route::get('/downGradeAdminLevel', 'AdminController@downGradeAdminLevel')->middleware('auth');


