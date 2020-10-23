<?php

use Illuminate\Support\Facades\Route;

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
Route::resource('/',"App\Http\Controllers\GCalendarController");
Route::resource('/kor',"App\Http\Controllers\GCalendarController");
Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'App\Http\Controllers\GCalendarController@oauth']);
