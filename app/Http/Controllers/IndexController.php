<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(Request $request) {}

    public function index(Request $request)
    {
        $data = $this->loadIndexData->execute();

        return view('index', ['data' => $data]);
    }
}
