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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', '\App\Http\Controllers\Api\RegisterController@register');
Route::post('/login', '\App\Http\Controllers\Api\LoginController@authenticate');
Route::post('/bookmarks/store', '\App\Http\Controllers\Api\BookmarkController@store');
Route::get('/bookmarks/all', '\App\Http\Controllers\Api\BookmarkController@all');
Route::get('/bookmarks/edit/{id}', '\App\Http\Controllers\Api\BookmarkController@getBookmark');
Route::put('/bookmarks/edit/{id}', '\App\Http\Controllers\Api\BookmarkController@update');
Route::delete('/bookmarks/delete/{id}', '\App\Http\Controllers\Api\BookmarkController@destroy');
Route::get('/aebi-schmidt/all-data', '\App\Http\Controllers\Api\BookmarkController@getAllData');