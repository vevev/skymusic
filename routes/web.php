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

Route::get('/mp3/{slug}/{id}.html', 'SongSkymusicController@index')->name('song-skymusic');
Route::get('/song/{slug}/{id}.html', 'SongController@index')->name('song');
Route::get('/search/{query_string}', 'SearchController@index')->name('search-get');
Route::get('/search-song/{query_string}', 'SkymusicSearchController@index')->name('search-skymusic-get');
Route::post('/search/', 'SearchController@post')->name('search-post');
