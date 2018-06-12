<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/result', 'HomeController@result');
    Route::get('/leader', 'HomeController@leader');
    Route::post('/bet/{id}', 'HomeController@bet');
    Route::resource('team', 'TeamController');
    Route::resource('match', 'MatchController');
    Route::get('test', 'TestController@index');
    Route::post('/recount', 'HomeController@recount');
});
