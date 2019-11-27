<?php

namespace App\Http\Controllers;

use App\Models\NCTSong;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use App\Acme\Services\Fetchs\CrawlDownloadLink;

class DownloadController extends Controller
{
    private $crawler;

    private $song;

    private $carbon;

    private $cache_key;

    const CACHE_EXPIRES_MINUTES = 7200;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CrawlDownloadLink $crawler, NCTSong $song, Carbon $carbon)
    {
        $this->crawler = $crawler;
        $this->song    = $song;
        $this->carbon  = $carbon;

        $this->slug      = Request::route('slug');
        $this->id        = Request::route('id');
        $this->cache_key = 'dl:' . $this->id;
    }

    /**
     * Tra lai link play cho client
     *
     * @return [type] [description]
     */
    public function play()
    {
        // Kiểm tra xem trong REDIS co link hay chua, neu co roi thi tra lai link
        if ($dl = Cache::get($this->cache_key)) {
            return redirect($dl);
        }

        // Kiểm tra xem trong DB có bài hát này hay chưa, nếu chưa sẽ trả lại //
        if ( ! $song = $this->song->findById($this->id)) {
            return '//';
        }

        $dl = $this->crawler->crawl($song->song_id);
        if (is_string($dl)) {
            Cache::put($this->cache_key, $dl, $this->carbon->addMinutes(self::CACHE_EXPIRES_MINUTES));

            return redirect($dl);
        }

        if ($dl = $this->crawler->crawlLinkPlay($song->key)) {
            Cache::put($this->cache_key, $dl, $this->carbon->addMinutes(self::CACHE_EXPIRES_MINUTES));

            return redirect($dl);
        }
    }

    /**
     * Tra lai link play cho client
     *
     * @return [type] [description]
     */
    public function link()
    {
        // Kiểm tra xem trong REDIS co link hay chua, neu co roi thi tra lai link
        if ($dl = Cache::get($this->cache_key)) {
            return redirect($dl);
        }

        // Kiểm tra xem trong DB có bài hát này hay chưa, nếu chưa sẽ trả lại //
        if ( ! $song = $this->song->findById($this->id)) {
            return '//';
        }

        $dl = $this->crawler->crawl($song->song_id);
        if (is_string($dl)) {
            Cache::put($this->cache_key, $dl, $this->carbon->addMinutes(self::CACHE_EXPIRES_MINUTES));

            return redirect($dl);
        }

        if (604 != $dl && $dl = $this->crawler->crawlLinkPlay($song->key)) {
            Cache::put($this->cache_key, $dl, $this->carbon->addMinutes(self::CACHE_EXPIRES_MINUTES));

            return redirect($dl);
        }
    }
}
