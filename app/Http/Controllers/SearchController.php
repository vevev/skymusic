<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadSearchData;

class SearchController extends Controller
{
    private $loadSearchData;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(LoadSearchData $loadSearchData)
    {
        $this->loadSearchData = $loadSearchData;
    }

    /**
     * Index
     *
     * @param      Request  $request
     *
     * @return     View
     */
    public function index(Request $request, Core $core)
    {

        $data           = $this->loadSearchData->execute($request->query_string, $request->page ?? 1);
        $data['__core'] = $core;

        Page::$title       = "Kết quả cho: " . $request->query_string;
        Page::$description = "Kết quả cho: " . $request->query_string;
        Page::$NO_INDEX    = 1;

        return view(Core::viewPath('search'), $data);
    }

    /**
     * Handle Post request
     *
     * @param      Request  $request
     *
     * @return     View
     */
    public function post(Request $request)
    {
        if ( ! $query_string = $request->get('q')) {
            return ['error'];
        }

        if ($request->ajax()) {
            $response = $this->loadSearchData->execute($query_string, $request->page ?? 1);

            return response()->json($response);
        }

        return redirect(route('search-get', ['query_string' => $query_string]), 301);
    }
}
