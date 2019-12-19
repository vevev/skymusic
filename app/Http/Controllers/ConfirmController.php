<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use App\Models\NCTSong;
use App\Models\SKYMUSIC_Song;

class ConfirmController extends Controller
{
    private $songSky;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NCTSong $song, Core $core, SKYMUSIC_Song $songSky)
    {
        $this->song    = $song;
        $this->core    = $core;
        $this->songSky = $songSky;
    }

    /**
     * { function_description }
     *
     * @param  string $slug The slug
     * @param  string $id   The identifier
     * @return <type> ( description_of_the_return_value )
     */
    public function index(string $slug, string $id)
    {
        if ( ! $song = $this->song->findById($id)) {
            abort(404);
        }

        Page::$NO_INDEX = 1;

        return view(Core::viewPath('confirm'), ['song' => $song, '__core' => $this->core]);
    }

    /**
     * { function_description }
     *
     * @param      string  $slug   The slug
     * @param      string  $id     The identifier
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function skymusic(string $slug, string $id)
    {
        if ( ! $song = $this->songSky->findByKey($id)) {
            abort(404);
        }

        Page::$NO_INDEX = 1;

        return view(Core::viewPath('confirm-skymusic'), ['song' => $song, '__core' => $this->core]);
    }

    /**
     * { function_description }
     *
     * @param  string $slug The slug
     * @param  string $id   The identifier
     * @return <type> ( description_of_the_return_value )
     */
    public function disclaimers()
    {
        Page::$title       = 'Điều khoản sử dụng';
        Page::$description = 'Điều khoản sử dụng.';

        return view(Core::viewPath('rule'), ['__core' => $this->core]);
    }
}
