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

        if ( ! $topic = config('topics.' . $slug)) {
            throw new PlaylistNotFoundException;
        }

        $playlists = $this->loadTopics->execute($topic['alias'], $request->page ?? 1);

        Page::$title       = $topic['title'];
        Page::$description = $topic['description'];

        return view(
            Core::viewPath('playlists'),
            ['__core' => $core, 'playlists' => $playlists, 'topic' => $topic]
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
