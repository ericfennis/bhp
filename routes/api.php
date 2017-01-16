<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('/companies', function(){
	return App\Company::all();
});

Route::get('/people', function(){
	return App\Person::all();
});

Route::get('/list', 'ListController@getJSON');

Route::get('/walkpath/name/{name}', 'WalkpathController@getWalkpathExtern');
Route::get('/walkpath/{id}', 'WalkpathController@getWalkpath');

Route::get('/point/list', 'PointController@getAll');
Route::get('/point/add/{map}/{x}/{y}', 'PointController@addPoint');
Route::get('/point/del/{id}', 'PointController@delPoint');

Route::get('/events', 'gCalendarController@getEvents');

Route::get('/facilities', 'FacilityController@getFacilities');