<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadPlaylistData;
use App\Acme\Services\Adapters\LoadPlaylistsData;

class PlaylistController extends Controller
{
    private $loadPlaylistData;
    private $loadPlaylistsData;

    public function __construct(LoadPlaylistData $loadPlaylistData, LoadPlaylistsData $loadPlaylistsData)
    {
        $this->loadPlaylistData  = $loadPlaylistData;
        $this->loadPlaylistsData = $loadPlaylistsData;
    }

    /**
     * { function_description }
     *
     * @param  \Illuminate\Http\Request $request The request
     * @param  \App\Acme\Core           $core    The core
     * @return <type>                   ( description_of_the_return_value )
     */
    public function index(Request $request, Core $core)
    {
        $data              = $this->loadPlaylistsData->execute($request->page ?? 1);
        Page::$title       = "Playlist";
        Page::$description = "Playlist";

        return view(
            Core::viewPath('playlists'),
            ['__core' => $core, 'playlists' => $data]
        );
    }

    /**
     * { function_description }
     *
     * @param  \Illuminate\Http\Request $request The request
     * @param  \App\Acme\Core           $core    The core
     * @return <type>                   ( description_of_the_return_value )
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
