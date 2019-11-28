<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(Request $request) {}

    public function index(Request $request, Core $core)
    {
        $data = ['__core' => $core]; //$this->loadIndexData->execute();

        return view(Core::viewPath('index'), $data);
    }
}
