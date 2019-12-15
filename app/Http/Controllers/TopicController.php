<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Exceptions\PlaylistNotFoundException;
use App\Acme\Services\Adapters\LoadTopicsData;

class TopicController extends Controller
{
    private $loadTopics;

    public function __construct(LoadTopicsData $loadTopics)
    {
        $this->loadTopics = $loadTopics;
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
        $slug = $request->route('slug', 'playlist-moi');
        if ( ! $slug = config('topics.' . $slug)) {
            throw new PlaylistNotFoundException;
        }

        $data = $this->loadTopics->execute($slug['alias'], $request->page ?? 1);

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
