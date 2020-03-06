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

        Page::$title       = 'Tải Nhạc Mp3 Miễn Phí CỰC NHANH Về Máy, Nhạc Hay 2020';
        Page::$description = 'Tải nhạc miễn phí về máy điện thoại ♫, tải nhạc chất lượng cao, tải nhạc về thẻ nhớ, tải nhạc Mp3 dễ dàng ♥. Download nhạc HAY NHẤT, nghe nhạc online và tải về nhanh chóng ♫.';

        return view(Core::viewPath('index'), $data);
    }

    public function logos()
    {
        return view(Core::viewPath('logos'));
    }
}
