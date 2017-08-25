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
Route::get('/createNews', 'NewsController@create');
Route::post('/createNews', 'NewsController@store');

Route::get('/medias', function() {
	return view('medias', array('imageUrl' => 'img/galerie-grp.jpg'));
});

Route::get('/agenda', 'EventController@index');
Route::get('/agenda/{id}', 'EventController@show')->where('id', '[0-9]+');
Route::get('/createEvent', 'EventController@formCreate');
Route::post('/createEvent', 'EventController@store');
Route::post('/{id}/participe', 'EventController@participe')->where('id', '[0-9]+');
Route::post('/{id}/desinscription', 'EventController@desinscription')->where('id', '[0-9]+');
Route::get('/contact', function() {
	return view('contact', array('imageUrl' => 'img/contact.JPG'));
});

Route::get('/adminUser', 'AdminController@index');
Route::get('/upGradeAdminLevel', 'AdminController@upGradeAdminLevel');
Route::get('/downGradeAdminLevel', 'AdminController@downGradeAdminLevel');
	# code...

//Route::get('/home', 'HomeController@index')->name('home');
