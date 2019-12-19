<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
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
    public function index(Request $request, Core $core)
    {
        $data           = $this->loadSearchData->execute($request->query_string, $request->page ?? 1);
        $data['__core'] = $core;

        Page::$title       = "Kết quả cho: " . $request->query_string;
        Page::$description = "Kết quả cho: " . $request->query_string;
        Page::$NO_INDEX    = 1;
        Page::$IS_ADSENSE  = 0;

        return view(Core::viewPath('search-skymusic'), $data);
    }
}
