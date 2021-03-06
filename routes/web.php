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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');
Route::resource('bookmarks', 'BookmarkController');
Route::resource('subscriptions', 'SubscriptionController');

Route::get('/weather', 'SubscriptionController@getWeather');
Route::get('/currency-list', 'SubscriptionController@getCurencyList');
Route::get('/date', 'SubscriptionController@getDate');
