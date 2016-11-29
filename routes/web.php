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

Auth::routes();

Route::get('/home', 'HomeController@index');

<<<<<<< HEAD
Route::get('/map', 'MapController@index');
=======
Route::get('/list', 'ListController@index');

Route::get('/api/companies', function(){
	return App\Company::all();
});
>>>>>>> companies
