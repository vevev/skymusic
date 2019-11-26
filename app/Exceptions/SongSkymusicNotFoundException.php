<?php

namespace App\Exceptions;

use Exception;

class SongSkymusicNotFoundException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return view('404-song-skymusic', ['message' => 'Bai Hat Khong Ton Tai']);
    }
}
