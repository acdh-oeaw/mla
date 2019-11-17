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

Route::resource('/saints', 'Api\SaintController');
Route::resource('/monasteries', 'Api\MonasteryController');
Route::resource('/codices', 'Api\CodexController');
Route::resource('/entries', 'Api\EntryController');
Route::resource('/files', 'Api\FileController');
Route::get('/search', 'Api\SearchController@search');
