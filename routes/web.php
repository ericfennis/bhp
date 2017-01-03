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

Route::get("/admin", function(){
   return View::make("adminhome");
})->middleware('auth');


Route::get('/home', 'HomeController@index');

Auth::routes();


Route::get('/map', 'MapController@index');

Route::get('/list', 'ListController@index');

Route::group(['middleware' => 'auth'], function()
{
	//gegenereerde crud
	Route::resource('company','CompanyController');
	Route::resource('person','PersonController');
	Route::resource('walkpath','WalkpathController');
	//automatische crud
	Route::resource('point','PointController');
});

//Events
Route::resource('calendar','gCalendarController');
Route::get('oauth','gCalendarController@oauth');