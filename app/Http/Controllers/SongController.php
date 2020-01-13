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
        if ($request->slug_unverify) {
            return view(Core::viewPath('song-slug'));
        }

        $data = $this->loadSongData->execute($request->id);

        Page::$title       = 'Tải bài hát ' . $data['song']->name . ' Mp3 - Download nhạc miễn phí';
        Page::$description = 'Tải nhạc Mp3, Tải về bài hát ' . $data['song']->name . ' - ' . $data['song']->single . '.  Miễn phí download về máy. Tải dễ dàng và nhanh chóng.';

        // Nếu không có skymusic thì không hiển thị adsense
        if ( ! $data['song']->hasSkymusic) {
            Page::$IS_ADSENSE = 0;
        }

        // Nếu không có skymusic thì không hiển thị adsense
        if ( ! $data['song']->hasSkymusic && ! $data['song']->canDownload) {
            Page::$NO_INDEX = true;
        }

        return view(
            Core::viewPath('song'),
            array_merge(['__core' => $core], $data)
        );
    }
}
