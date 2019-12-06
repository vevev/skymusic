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

        Page::$title       = 'Tai nhac 123';
        Page::$description = 'Tai nhac 123';

        return view(Core::viewPath('index'), $data);
    }
}
