<?php

namespace App\Exceptions;

use Exception;
use App\Acme\Core;

class FetchSongOfPlaylistFailedException extends Exception
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return view(Core::viewPath('error'), ['message' => 'Lỗi hệ thống']);
    }
}
