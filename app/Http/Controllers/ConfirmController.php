<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Models\NCTSong;

class ConfirmController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NCTSong $song, Core $core)
    {
        $this->song = $song;
        $this->core = $core;
    }

    /**
     * { function_description }
     *
     * @param      string  $slug   The slug
     * @param      string  $id     The identifier
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function index(string $slug, string $id)
    {
        if ( ! $song = $this->song->findById($id)) {
            abort(404);
        }

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
    public function disclaimers()
    {
        return view(Core::viewPath('rule'));
    }
}
