<?php

namespace App\Http\Controllers;

use App\Acme\Core;
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
        if ($query_string = $request->get('q')) {
            if ($request->ajax()) {
                return response()
                    ->json(
                        $this->loadSearchData
                             ->execute(
                                  $query_string,
                                  $request->page ?? 1
                              )
                    );
            }

            return redirect(route('search-get', ['query_string' => $query_string]), 301);
        }

        return view('search-query-error');
    }
}
