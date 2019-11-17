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

Route::get('/', function() {
    return view('index');
});

Route::get('/image/monastery/{id}', 'ImageController@getMonasteryImage');
Route::get('/image/codex/{id}', 'ImageController@getCodexImage');
Route::get('/image/codex/{id}/{number}', 'ImageController@getCodexImage');
Route::get('/dzi/{id}', 'ImageController@dzi');
Route::get('/dzi/{id}/{page}', 'ImageController@dzi');
Route::get('/dzi/{file_id}/{page}_files/{folder}/{image}', 'ImageController@getTile');

Route::fallback(function() {
    return redirect('/#/'.Route::getCurrentRoute()->parameters['fallbackPlaceholder']);
});
