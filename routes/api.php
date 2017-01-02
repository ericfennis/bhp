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

Route::get('/walkpath/{id}', 'WalkpathController@getWalkpath');

Route::get('/events', 'gCalendarController@getEvents');

// Route::get('/walkpath/{id}', function($id){
// 	$company = App\Company::findOrFail($id);
// 	$walkpathpoints = $company->walkpath->walkpathpoints;
// 	$points = array();
// 	foreach ($walkpathpoints as $walkpath) {
// 		array_push($points, App\Point::find($walkpath->id));
// 	}
	
// 	return $points;
// });

