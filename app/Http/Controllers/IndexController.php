<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadIndexData;

class IndexController extends Controller
{
    private $loadIndexData;

    public function __construct(Request $request, LoadIndexData $loadIndexData)
    {
        $this->loadIndexData = $loadIndexData;
    }

    public function index(Request $request, Core $core)
    {
        $data = ['__core' => $core, 'data' => $this->loadIndexData->execute()];

        Page::$title       = 'Tải Nhạc CỰC NHANH Về Máy, Nhạc Hay 2019';
        Page::$description = 'Tải nhạc về máy điện thoại ♫, tải nhạc về thẻ nhớ, tải nhạc dễ dàng ♫. Download nhạc HAY NHẤT, nghe nhạc online và tải về nhanh chóng ♫.';

        return view(Core::viewPath('index'), $data);
    }

    public function logos()
    {
        return view(Core::viewPath('logos'));
    }

    public function player()
    {
        return view(Core::viewPath('player'));
    }
}
