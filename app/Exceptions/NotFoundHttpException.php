<?php

namespace App\Exceptions;

use Exception;
use App\Acme\Core;
use App\Acme\Page;

class NotFoundHttpException extends Exception
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
        Page::$title       = "Không tìm thấy nội dung !";
        Page::$description = "Không tìm thấy nội dung !";

        return view(
            Core::viewPath('404'),
            ['message' => 'Bai Hat Khong Ton Tai']
        );
    }
}
