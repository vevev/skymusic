<?php

namespace App\Exceptions;

use Exception;
use App\Acme\Core;

class KeywordNotFoundInSearchRequestException extends Exception
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
        if ($request->ajax()) {
            return response()->json(['error' => 'REQUEST_INVALID'])->send();
        } else {
            return view(Core::viewPath('error'), ['message' => 'Truy cập của bạn bị từ chối !']);
        }
    }
}
