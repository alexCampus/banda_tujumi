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
Route::get('storage/{categorie}/{filename}', function ($categorie, $filename)
{
    $path = storage_path('app/public/' . $categorie . '/' . $filename);
    if (!File::exists($path)) {
    
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
Route::get('password/email',                  'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::post('password/email',                 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}/{email}',  'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset',                 'Auth\ResetPasswordController@reset')->name('password.reset');

Route::get('/',                               'HomeController@index')->name('home');
Route::get('/prestation',                     'HomeController@indexPrestation');
Route::get('/presentation',                   'HomeController@presentation');
Route::get('/profil',                         'HomeController@indexProfil')->middleware('auth');
Route::get('/updateProfil',                   'HomeController@updateProfil')->middleware('auth');
Route::post('/updateProfil',                  'HomeController@updateProfil')->middleware('auth');

Route::get('/actualites',                     'NewsController@index');
Route::get('/createNews',                     'NewsController@create')->middleware('auth');
Route::post('/createNews',                    'NewsController@store')->middleware('auth');
Route::delete('/deleteNews/{id}',               'NewsController@delete')->where('id', '[0-9]+')->middleware('auth');
Route::get('/updateNews/{id}',                'NewsController@viewUpdate')->where('id', '[0-9]+')->middleware('auth');
Route::post('/updateNews/{id}',               'NewsController@update')->where('id', '[0-9]+')->middleware('auth');

Route::get('/agenda',                         'EventController@index')->middleware('auth');
Route::get('/agenda/{id}',                    'EventController@show')->where('id', '[0-9]+')->middleware('auth');
Route::get('/createEvent',                    'EventController@formCreate')->middleware('auth');
Route::post('/createEvent',                   'EventController@store')->middleware('auth');
Route::post('/{id}/participe',                'EventController@participe')->where('id', '[0-9]+')->middleware('auth');
Route::post('/{id}/desinscription',           'EventController@desinscription')->where('id', '[0-9]+')->middleware('auth');
Route::get('/updateEvent/{id}',               'EventController@updateView')->where('id', '[0-9]+')->middleware('auth');
Route::post('/updateEvent/{id}',              'EventController@update')->where('id', '[0-9]+')->middleware('auth');
Route::delete('/deleteEvent/{id}',            'EventController@delete')->where('id', '[0-9]+')->middleware('auth');

Route::get('/contact',                        'ContactController@index');
Route::post('/contact',                       'ContactController@send');

Route::get('/upGradeAdminLevel/{id}',         'AdminController@upGradeAdminLevel')->where('id', '[0-9]+')->middleware('auth');
Route::get('/downGradeAdminLevel/{id}',       'AdminController@downGradeAdminLevel')->where('id', '[0-9]+')->middleware('auth');
Route::post('/newUser',                       'AdminController@newUser')->middleware('auth');

Route::get('/medias',                         'ImagesController@index');	
Route::get('/uploadImages',                   'ImagesController@uploadView')->middleware('auth');
Route::post('/uploadImages',                  'ImagesController@store')->middleware('auth');
Route::get('/deleteImages',                   'ImagesController@deleteView')->middleware('auth');
Route::post('/deleteImages/{id}',             'ImagesController@deleteStore')->where('id', '[0-9]+')->middleware('auth');

Route::get('/admin',                           'AdminController@index')->middleware('auth');
Route::get('/admin/adminUser',                 'AdminController@adminUser')->middleware('auth');
Route::get('/admin/adminNews',                 'AdminController@adminNews')->middleware('auth');
Route::get('/admin/adminPrestation',           'AdminController@adminPrestation')->middleware('auth');
