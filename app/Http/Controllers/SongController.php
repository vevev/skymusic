<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadSongData;

class SongController extends Controller
{
    private $loadSongData;

    public function __construct(LoadSongData $loadSongData)
    {
        $this->loadSongData = $loadSongData;
    }

    public function index(Request $request)
    {
        $song = $this->loadSongData->execute($request->id);

        return view('song', ['song' => $song]);
    }
}
