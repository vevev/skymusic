<?php

namespace App\Http\Controllers;

use Throwable;
use App\Acme\Core;
use App\Models\NCTSong;
use App\Models\NCTPlaylist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Acme\Services\Fetchs\CrawlDownloadLink;
use App\Acme\Services\Fetchs\FetchSongOfPlaylist;

class DownloadController extends Controller
{
    private $crawler;

    private $song;

    private $playlist;

    private $carbon;

    private $cache_key;

    private $fetchSongOfPlaylist;

    const CACHE_EXPIRES_MINUTES = 7200;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CrawlDownloadLink $crawler, NCTSong $song, NCTPlaylist $playlist, Carbon $carbon, Request $request, FetchSongOfPlaylist $fetchSongOfPlaylist)
    {

        $this->crawler             = $crawler;
        $this->song                = $song;
        $this->playlist            = $playlist;
        $this->carbon              = $carbon;
        $this->request             = $request;
        $this->slug                = $request->route('slug');
        $this->id                  = $request->route('id');
        $this->cache_key           = 'link:' . $this->id;
        $this->re_cache            = $this->request->header('ReCache');
        $this->fetchSongOfPlaylist = $fetchSongOfPlaylist;
    }

    /**
     * Tra lai link play cho client
     *
     * @return [type] [description]
     */
    public function play()
    {
        if (request()->slug_unverify || request()->id_unverify) {
           return view(Core::viewPath('song-slug'));
        }

        $link = $this->getLinkFromCache();

        if ($link) {
            return redirect($link);
        }

        // Kiểm tra xem trong DB có bài hát này hay chưa, nếu chưa sẽ trả lại //
        if ( ! $song = $this->song->findById($this->id)) {
            return '//';
        }

        if (optional($song->sky)->count()) {
            if ($link = $this->crawler->getLinkSkymusic($song->sky->skyKey)) {
                $this->setCacheLink($link);
            }
        }

        // Lay link download
        if ($link = $this->crawler->crawl($song->song_id)) {
            $this->setCacheLink($link);
        }

        // Lay link iframe
        elseif ($link = $this->crawler->getLinkIframe($song->key)) {
            $this->setCacheLink($link);
        }

        // lay link play
        elseif ($link = $this->crawler->crawlLinkPlay($song->key)) {
            $this->setCacheLink($link);
        }

        if ($link) {
            return $this->re_cache ? '' : redirect($link);
        }
    }

    /**
     * Gets the link from cache.
     *
     * @return <type> The link from cache.
     */
    private function getLinkFromCache()
    {
        if ($this->re_cache) {
            return null;
        }

        return Cache::get($this->cache_key);
    }

    /**
     * Sets the cache link.
     *
     * @param string $link The new value
     */
    private function setCacheLink(string $link)
    {
        Cache::put(
            $this->cache_key,
            $link,
            $this->carbon->addMinutes(self::CACHE_EXPIRES_MINUTES)
        );
    }

    /**
     * Tra lai link play cho client
     *
     * @return [type] [description]
     */
    public function link()
    {
        $link = $this->getLinkFromCache();

        if ($link) {
            return redirect($link);
        }

        // Kiểm tra xem trong DB có bài hát này hay chưa, nếu chưa sẽ trả lại //
        if ( ! $song = $this->song->findById($this->id)) {
            return '//';
        }

        $link = $this->crawler->crawl($song->song_id);
        if (is_string($link)) {
            Cache::put($this->cache_key, $link, $this->carbon->addMinutes(self::CACHE_EXPIRES_MINUTES));

            return redirect($link);
        }

        if (604 != $link && $link = $this->crawler->crawlLinkPlay($song->key)) {
            Cache::put($this->cache_key, $link, $this->carbon->addMinutes(self::CACHE_EXPIRES_MINUTES));

            return redirect($link);
        }
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function playlistInfo()
    {
        try {
            return array_map(function ($e) {
                return ['id' => $e->songKey, 'url' => $e->location];
            }, $this->fetchSongOfPlaylist->execute($this->playlist->findKeyById($this->id)));
        } catch (Throwable $e) {
            return response()->json([])->send();
        }
    }
}
