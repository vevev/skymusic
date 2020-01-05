<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
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
     * @param  string $slug The slug
     * @param  string $id   The identifier
     * @return <type> ( description_of_the_return_value )
     */
    public function index(string $slug, string $id)
    {
        if ( ! $song = $this->song->findById($id)) {
            abort(404);
        }

        // Nếu không có skymusic thì không hiển thị adsense
        if ( ! $song->hasSkymusic) {
            Page::$IS_ADSENSE = 0;
        }
        Page::$NO_INDEX = 1;

        return view(Core::viewPath('confirm'), ['song' => $song, '__core' => $this->core]);
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
