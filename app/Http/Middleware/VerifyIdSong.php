<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIdSong
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->id_unverify = $this->verifyId($request->id);

        return $next($request);
    }

    private function verifyId($id)
    {
        $list = [
            'b2ki2Wga0XWX', '2Lv43QXMeumT', 'lGg0mLsOT3qm', 'aCQIv6EGgdM8', 'wk1C93W74Gnf',
            'wFxBcbOz14GV', 'PKDK5YVEdgWH', 'iOYzPfp6lchL', '5z6HLpEj8AKI', 'BSthd9FKKLm3',
            'Hyda6ukMOr1t', 'PWAHV0oEsD', 'Twdo2DGj5gtH', 'VbyPgbZRh2gQ',
        ];

        return in_array($id, $list);
    }
}
