<?php

namespace App\Exceptions;

use Exception;

class ExtractSearchHtmlFailException extends Exception
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
        Page::$title       = "Lỗi bất ngờ !";
        Page::$description = "Lỗi bất ngờ !";

        return view(
            Core::viewPath('404'),
            ['message' => 'Chúng tôi tạm thời không xử lý được yêu cầu tìm kiếm của bạn, bạn vui lòng thử lại sau!']
        );
    }
}
