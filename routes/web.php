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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/map', 'SearchController@showAll');
Route::post('/map', 'SearchController@search');

Route::post('/marker', 'SearchController@searchMap');
Route::get('/marker', 'SearchController@searchMapAll');

Route::get('/planner', function () {
    return view('planner');
});
Route::post('/create-user', 'UserController@store');

Route::get('/validation','ValidationController@showform');
Route::post('/validation','ValidationController@validateform');

Route::get('/register', function () {
    return view('register2');
});
