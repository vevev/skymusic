<?php

namespace App\Exceptions;

use Exception;

class UpdateSongFailException extends Exception
{
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
