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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/agenda', 'EventController@index');
Route::get('/agenda/{id}', 'EventController@show')->where('id', '[0-9]+');
Route::get('/createEvent', 'EventController@formCreate');
Route::post('/createEvent', 'EventController@store');
Route::post('/{id}/participe', 'EventController@participe')->where('id', '[0-9]+');
Route::post('/{id}/desinscription', 'EventController@desinscription')->where('id', '[0-9]+');


Auth::routes();

Route::get('/home', 'HomeController@index');
