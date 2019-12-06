<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadPlaylistData;

class PlaylistController extends Controller
{
    private $loadPlaylistData;

    public function __construct(LoadPlaylistData $loadPlaylistData)
    {
        $this->loadPlaylistData = $loadPlaylistData;
    }

    public function index(Request $request, Core $core)
    {
        $data = $this->loadPlaylistData->execute($request->id);

        Page::$title       = $data['song']->name . ' | Tai nhac 123';
        Page::$description = $data['song']->name . ' | Tai nhac 123';

        return view(
            Core::viewPath('song'),
            array_merge(['__core' => $core], $data)
        );
    }
}
