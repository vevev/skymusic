<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Interacts\CacheTop100;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\Fetchs\FetchTop100Song;
use App\Exceptions\CrawlTop100SongFailException;
use App\Acme\Services\Extracts\ExtractTop100Song;
use App\Exceptions\ExtractTop100SongFailException;

class LoadTop100Song
{
    private $fetchTop100Song;
    private $cacheTop100;
    private $extractTop100Song;
    private $createSongs;
    private $mergeSkyMusic;
    private $skymusicLoadSearchData;

    public function __construct(
        FetchTop100Song $fetchTop100Song,
        CacheTop100 $cacheTop100,
        ExtractTop100Song $extractTop100Song,
        CreateSongs $createSongs
    ) {
        $this->fetchTop100Song   = $fetchTop100Song;
        $this->cacheTop100       = $cacheTop100;
        $this->extractTop100Song = $extractTop100Song;
        $this->createSongs       = $createSongs;
    }

    public function execute(string $category = 'nhac-tre', string $category_id = 'm3liaiy6vVsF', bool $renewCache = false)
    {
        if ( ! $renewCache) {
            return $this->cacheTop100->get($category, $category_id);
        }

        if ( ! $html = $this->fetchTop100Song->execute($category, $category_id)) {
            throw new CrawlTop100SongFailException;
        }

        if ( ! $searchData = $this->extractTop100Song->execute($html)) {
            throw new ExtractTop100SongFailException;
        }

        if ( ! $songs = $this->createSongs->execute($searchData, true)) {
            throw new CreateSongsFailException;
        }

        $songs->load('listens');
        $this->cacheTop100->set($category, $category_id, $songs->toArray());

        return response()->json($songs)->send();
    }
}
