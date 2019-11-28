<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadSongData;

class SongController extends Controller
{
    private $loadSongData;

    public function __construct(LoadSongData $loadSongData)
    {
        $this->loadSongData = $loadSongData;
    }

    public function index(Request $request, Core $core)
    {
        $song = $this->loadSongData->execute($request->id);

        return view(Core::viewPath('song'), ['song' => $song, '__core' => $core]);
    }
}
