<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acme\Services\Adapters\SkymusicLoadSearchData;

class SkymusicSearchController extends Controller
{
    private $loadSearchData;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(SkymusicLoadSearchData $loadSearchData)
    {
        $this->loadSearchData = $loadSearchData;
    }

    /**
     * [index description]
     *
     * @param  Request $request        [description]
     * @return [type]  [description]
     */
    public function index(Request $request)
    {
        $data = $this->loadSearchData->execute($request->query_string, $request->page ?? 1);

        return view('search-skymusic', $data);
    }
}
