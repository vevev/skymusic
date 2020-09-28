<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function redirectZingDetailToSearch(Request $request)
    {
        $slug = $request->route('zing_slug', null);
        $url  = $slug ? route('search', ['query_string' => Str::slug($slug, " ")]) : router("home");

        return redirect($url, 302)->send();
    }

    /**
     * { function_description }
     *
     * @return     string  ( description_of_the_return_value )
     */
    public function blank()
    {
        return "";
    }
}
