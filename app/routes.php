<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/', 'CalendarController@index');
Route::any('/other', 'CalendarController@other_stages');
Route::get('/auth', 'CalendarController@authenticate');
Route::get('/oauth2callback', 'CalendarController@oauth2callback');