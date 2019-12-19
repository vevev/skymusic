<?php

namespace App\Http\Controllers;

use App\Models\NCTSong;
use Illuminate\Http\Request;
use App\Models\SKYMUSIC_Song;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Acme\Services\Fetchs\CrawlDownloadLink;
use App\Acme\Services\Adapters\LoadPlaylistData;

class DownloadController extends Controller
{
    private $crawler;

    private $song;

    private $carbon;

    private $cache_key;

    private $loadPlaylist;

    private $songSky;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CrawlDownloadLink $crawler, NCTSong $song, Carbon $carbon, Request $request, LoadPlaylistData $loadPlaylist, SKYMUSIC_Song $songSky)
    {

        $this->crawler      = $crawler;
        $this->song         = $song;
        $this->carbon       = $carbon;
        $this->request      = $request;
        $this->slug         = $request->route('slug');
        $this->id           = $request->route('id');
        $this->playlist_id  = $request->route('playlist_id');
        $this->cache_key    = sprintf(config('cache.key.link_download.format'), $this->id);
        $this->re_cache     = $this->request->header('ReCache');
        $this->loadPlaylist = $loadPlaylist;
        $this->songSky      = $songSky;
    }

    /**
     * Tra lai link play cho client
     *
     * @return [type] [description]
     */
    public function play()
    {
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
     * Tra lai link play cho client
     *
     * @return [type] [description]
     */
    public function skymusic()
    {
        if ($link = $this->getLinkFromCache()) {
            return redirect($link);
        }

        // Kiểm tra xem trong DB có bài hát này hay chưa, nếu chưa sẽ trả lại
        $song = $this->songSky->findByKey($this->id);
        if ( ! $song || ! in_array($song->songType, [1, 2])) {
            return '//';
        }

        if ($link = $this->crawler->getLinkSkymusic($song->skyKey)) {
            $this->setCacheLink($link);
        }

        if ($link) {
            return $this->re_cache ? '' : redirect($link);
        }
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function playlist()
    {
        if ($link = $this->getLinkFromCache()) {
            return redirect($link);
        } else {
            $this->loadPlaylist->execute($this->playlist_id, true);
        }

        return $this->play();
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
            $this->carbon->addMinutes(config('cache.key.link_download.CACHE_EXPIRES_MINUTES'))
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
}
