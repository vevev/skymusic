<?php

namespace App\Exceptions;

use Exception;
use App\Acme\Core;

class ExtractSearchHtmlException extends Exception
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
        logger('SEARCH_EXTRACT', ['query' => $request->q]);

        if ($request->ajax()) {
            return response()->json(['error' => 'SYSTEM_ERROR'])->send();
        } else {
            return view(Core::viewPath('error'), ['message' => 'Lỗi Hệ Thống !']);
        }
    }
}
