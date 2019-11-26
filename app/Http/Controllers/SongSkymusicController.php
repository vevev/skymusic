<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadSongSkymusicData;

class SongSkymusicController extends Controller
{
    private $loadSongData;

    public function __construct(LoadSongSkymusicData $loadSongData)
    {
        $this->loadSongData = $loadSongData;
    }

    public function index(Request $request)
    {
        $song = $this->loadSongData->execute($request->id);

        return view('song-skymusic', ['song' => $song]);
    }
}
