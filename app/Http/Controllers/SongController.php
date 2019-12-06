<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
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
        $data = $this->loadSongData->execute($request->id);

        Page::$title       = $data['song']->name . ' | Tai nhac 123';
        Page::$description = $data['song']->name . ' | Tai nhac 123';

        return view(
            Core::viewPath('song'),
            array_merge(['__core' => $core], $data)
        );
    }
}
