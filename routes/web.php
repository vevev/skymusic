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

Route::get('/', 'IndexController@index')->name('index');

Route::get('/tai-nhac/{slug}/{id}.html', 'SongController@index')->name('song');
Route::get('/mp3/{slug}/{id}.html', 'SongSkymusicController@index')->name('song-skymusic');

Route::get('/listen/{slug}.{id}.html', 'DownloadController@play')->name('listen');
Route::get('/{slug}~{id}.html', 'ConfirmController@index')->name('confirm');
Route::get('/download/{slug}.{id}.html', 'DownloadController@link')->name('download');
Route::get('/tim-kiem/{query_string}', 'SearchController@index')->name('search-get');
Route::get('/search/{query_string}', 'SkymusicSearchController@index')->name('search-skymusic-get');
Route::post('/search/', 'SearchController@post')->name('search-post');

Route::get('/unpublish/crawl-skymusic-database', 'UnpublishController@index')->name('crawl-skymusic-database');
