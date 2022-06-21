<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        DB::listen(
            function ($sql) {
                if(preg_match('#update `nct_song_options`#', $sql->sql) && isset($sql->bindings[0]) && $sql->bindings[0] == 1) {
                    \Log::debug('debug_nct_song_options', [$sql->sql, $sql->bindings, debug_backtrace()]);
                }
            }
        );
    }
}
