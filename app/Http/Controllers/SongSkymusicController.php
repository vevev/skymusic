<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadSongSkymusicData;

class SongSkymusicController extends Controller
{
    private $loadSongData;

    public function __construct(LoadSongSkymusicData $loadSongData)
    {
        $this->loadSongData = $loadSongData;
    }

    public function index(Request $request, Core $core)
    {
        $song           = $this->loadSongData->execute($request->id);
        $song['__core'] = $core;

        Page::$title       = 'Tải Bài Hát ' . $song['song']->title . ' Mp3 - Tải nhạc Mp3';
        Page::$description = 'Tải nhạc Mp3, Tải về bài hát ' . $song['song']->title . ' - ' . $song['song']->artists . '.  Miễn phí tải về máy, Tải dễ dàng và nhanh chóng.';

        return view(Core::viewPath('song-skymusic'), $song);
    }
}
