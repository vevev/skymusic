<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadTopicsData;

class TopicController extends Controller
{
    private $loadTopicsData;

    public function __construct(LoadTopicsData $loadTopicsData)
    {
        $this->loadTopicsData = $loadTopicsData;
    }

    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @param      \App\Acme\Core            $core     The core
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function index(Request $request, Core $core)
    {
        $data = $this->loadTopicsData->execute(132, $request->page ?? 1);

        Page::$title       = $data['song']->name . ' | Tai nhac 123';
        Page::$description = $data['song']->name . ' | Tai nhac 123';

        return view(
            Core::viewPath('playlists'),
            array_merge(['__core' => $core], $data)
        );
    }

    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @param      \App\Acme\Core            $core     The core
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function playlist(Request $request, Core $core)
    {
        $data = $this->loadPlaylistData->execute($request->id);

        Page::$title       = 'Playlist ' . $data['playlist']->name;
        Page::$description = 'Playlist ' . $data['playlist']->name;

        return view(
            Core::viewPath('playlist'),
            array_merge(['__core' => $core], $data)
        );
    }
}
