<?php
Auth::routes(['register' => false]);
Route::pattern('id', '[\w\_\-]{5,15}');
Route::pattern('playlist_id', '[\w\_\-]{5,15}');
Route::pattern('query', '[^/]+');
Route::pattern('querynonuni', '[a-z0-9\-]+');
Route::pattern('single_slug', '[a-z0-9\-]+');
Route::pattern('slug', '[^/\.]*');
Route::pattern('page', '\d+');

switch (config('app.domain')) {
    case 'skymusic.dev':
        Route::domain('skymusic.dev')
            ->group(base_path('routes/domains/trangtainhac.net.php'));
        // ->group(base_path('routes/domains/tainhac123.com.php'));
        break;
    case 'trangtainhacnet.dev':
        Route::domain('trangtainhacnet.dev')
            ->group(base_path('routes/domains/trangtainhac.net.php'));
        break;

    case 'test.tainhac123.com':
        Route::domain('trangtainhacnet.dev')
            ->group(base_path('routes/domains/trangtainhac.net.php'));
        break;

    case 'tainhac123.com':
        Route::domain('tainhac123.com')
            ->group(base_path('routes/domains/tainhac123.com.php'));
        break;
}
