<?php

Route::pattern('id', '[\w\_\-]{5,15}');
Route::pattern('playlist_id', '[\w\_\-]{5,15}');
Route::pattern('query', '[^/]+');
Route::pattern('querynonuni', '[a-z0-9\-]+');
Route::pattern('single_slug', '[a-z0-9\-]+');
Route::pattern('slug', '[^/\.]*');
Route::pattern('page', '\d+');

Route::get('/', 'IndexController@index')->name('index');
Route::get('/tai-bai-hat-{slug}-mp3/{id}.html', 'SongController@index')->name('song');
Route::get('/bai-hat/{slug}/{id}.html', 'SongSkymusicController@index')->name('song-skymusic');

Route::get('/danh-sach-phat-{slug}/{id}.html', 'PlaylistController@playlist')->name('playlist');
//Route::get('/playlists/{page?}', 'PlaylistController@index')->name('playlists');

Route::get('/topics/{page?}', 'TopicController@index')->name('playlists');
Route::get('/topics/{slug}/{page?}', 'TopicController@index')->name('playlists');

Route::match(['get', 'post'], '/listen/{slug}-mp3.{id}.html', 'DownloadController@skymusic')->name('listen-skymusic');

Route::match(['get', 'post'], '/listen/{slug}.{id}.html', 'DownloadController@play')->name('listen');
Route::match(['get', 'post'], '/listen/{slug}.{id}.{playlist_id}.html', 'DownloadController@playlist')->name('listen-playlist');
Route::get('/download/{slug}-mp3.{id}.html', 'DownloadController@skymusic')->name('download-skymusic');
Route::get('/download/{slug}.{id}.html', 'DownloadController@play')->name('download');

Route::get('/{slug}-mp3~{id}.html', 'ConfirmController@skymusic')->name('confirm-skymusic');
Route::get('/{slug}~{id}.html', 'ConfirmController@index')->name('confirm');
Route::get('/disclaimers.html', 'ConfirmController@disclaimers')->name('disclaimers');
Route::get('/tim-kiem/{query_string}', 'SearchController@index')->name('search');
Route::get('/search/{query_string}', 'SkymusicSearchController@index')->name('search-skymusic-get');
Route::get('/search-api/', 'SearchController@get')->name('search-get');
Route::post('/search/', 'SearchController@post')->name('search-post');

Route::get('/bang-xep-hang-bai-hat-viet-nam.html', 'BXHController@songVN')->name('bxh-song-vn');
Route::get('/bang-xep-hang-bai-hat-au-my.html', 'BXHController@songUS')->name('bxh-song-us');
Route::get('/bang-xep-hang-bai-hat-han-quoc.html', 'BXHController@songKR')->name('bxh-song-kr');

Route::get('/unpublish/{country}/{type}.html', 'BXHController@renew')->name('renew-bxh-cache');

Route::get('/unpublish/crawl-listen', 'CrawlListenController@index')->name('crawl-listen');

Route::get('/unpublish/crawl-skymusic-database/{reload?}', 'UnpublishController@index')->name('crawl-skymusic-database');

Route::get('/logos', 'IndexController@logos');
Route::get('/splayer', 'IndexController@player');
