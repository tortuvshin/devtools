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
    return view('landing');
});

Route::auth();

Route::get('/daily-surveys', 'PagesController@index');
Route::get('/daily-surveys/new', 'PagesController@newSurvey');
Route::get('/daily-surveys/{id}','PagesController@show');

Route::post('/surveys', 'SurveysController@create');
Route::get('/surveys', 'SurveysController@index');
Route::get('/surveys/new', 'SurveysController@newSurvey');
Route::get('/surveys/{id}','SurveysController@show');
