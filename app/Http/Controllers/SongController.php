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

        // Nếu không có skymusic thì không hiển thị adsense
        Page::$IS_ADSENSE = optional($data['song']->sky)->count() ?? false;

        Page::$title       = 'Tải Bài Hát ' . $data['song']->name . ' Mp3 - Tải nhạc Mp3';
        Page::$description = 'Tải nhạc Mp3, Tải về bài hát ' . $data['song']->name . ' - ' . $data['song']->single . '.  Miễn phí tải về máy, Tải dễ dàng và nhanh chóng.';

        return view(
            Core::viewPath('song'),
            array_merge(['__core' => $core], $data)
        );
    }
}
