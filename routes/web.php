<?php
Auth::routes(['register' => false]);
Route::pattern('id', '[\w\_\-]{5,15}');
Route::pattern('playlist_id', '[\w\_\-]{5,15}');
Route::pattern('query', '[^/]+');
Route::pattern('querynonuni', '[a-z0-9\-]+');
Route::pattern('single_slug', '[a-z0-9\-]+');
Route::pattern('slug', '[^/\.]*');
Route::pattern('page', '\d+');

if(preg_match('~BlackPink~i', $_SERVER['REQUEST_URI'])){
    abort(404);
}
   
$domain = config('app.domain');
switch ($domain) {
case 'skymusic.dev':
	Route::domain($domain)
		->group(base_path('routes/domains/trangtainhac.net.php'));
	// ->group(base_path('routes/domains/tainhac123.com.php'));
	break;
case 'skymusic.com':
	Route::domain($domain)
		->group(base_path('routes/domains/tainhac123.com.php'));
	// ->group(base_path('routes/domains/tainhac123.com.php'));
	break;
case 'trangtainhacnet.dev':
	Route::domain($domain)
		->group(base_path('routes/domains/trangtainhac.net.php'));
	break;

case 'trangtainhac.net':
	Route::domain($domain)
		->group(base_path('routes/domains/trangtainhac.net.php'));
	break;

case 'test.tainhac123.com':
	Route::domain($domain)
		->group(base_path('routes/domains/trangtainhac.net.php'));
	break;

case 'tainhac123.com':
	Route::domain($domain)
		->group(base_path('routes/domains/tainhac123.com.php'));
	break;
}
