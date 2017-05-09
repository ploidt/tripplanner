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

Route::get('/', function () {return view('welcome');});
Route::get('/homepage', function () {return view('homepage');});

Route::get('/map', 'SearchController@showAll');
Route::post('/map', 'SearchController@search');

Route::post('/marker', 'SearchController@searchMap');
Route::get('/marker', 'SearchController@searchMapAll');

Route::get('/preplanner', function () { return view('preplanner'); });
Route::post('/preplanner', 'PlannerController@store');

Route::get('/yourplanner', function () {
	if(\Auth::check()){
		return view('planner');
	}else{
		return view('preplanner');
	}
});

Route::post('/planner', 'AttractionController@searchAttraction');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('logout', array('uses' => 'HomeController@doLogout'));


Route::get('/attraction', function () {return view('detail');});
Route::get('/attraction/{id}', 'SearchController@searchId');


