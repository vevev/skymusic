<?php
namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadSearchData;
use App\Exceptions\KeywordNotFoundInSearchRequestException;

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
        $data              = $this->loadSearchData->execute($request->query_string, $request->page ?? 1);
        $data['__core']    = $core;
        Page::$title       = "Kết quả cho: " . $request->query_string;
        Page::$description = "Kết quả cho: " . $request->query_string;
        Page::$NO_INDEX    = 1;
        Page::$IS_ADSENSE  = 0;

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
            throw new KeywordNotFoundInSearchRequestException;
        }

        return redirect(route('search', ['query_string' => $query_string]), 301);
    }

    /**
     * Handle Post request
     *
     * @param      Request  $request
     *
     * @return     View
     */
    public function get(Request $request)
    {
        $query_string = $this->getQueryParams($request);

        $response = $this->loadSearchData->execute($query_string, $request->page ?? 1);

        return response()->json($response['results']);
    }

    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request  The request
     */
    public function redirectQueryToSlug(Request $request)
    {
        $url = route('search', ['query_string' => $this->getQueryParams($request)]);

        return redirect($url)->send();
    }

    /**
     * Gets the query parameters.
     *
     * @param      <type>                                                   $request  The request
     *
     * @throws     \App\Exceptions\KeywordNotFoundInSearchRequestException  (description)
     *
     * @return     <type>                                                   The query parameters.
     */
    private function getQueryParams($request)
    {
        if ( ! $query_string = $request->get('q')) {
            throw new KeywordNotFoundInSearchRequestException;
        }

        return $query_string;
    }
}
