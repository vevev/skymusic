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
        $list = ['b2ki2Wga0XWX'];

        return in_array($id, $list);
    }
}
