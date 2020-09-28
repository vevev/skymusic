<?php

namespace App\Http\Controllers;

use App\Acme\Core;

class CustomPageController extends Controller
{
    /**
     * { function_description }
     *
     * @param      \App\Acme\Core  $__core  The core
     *
     * @return     <type>          ( description_of_the_return_value )
     */
    public function nhacSonTungMtp(Core $__core)
    {
        return view(Core::viewPath('nhac-son-tung-mtp'), ['__core' => $__core]);
    }
}
