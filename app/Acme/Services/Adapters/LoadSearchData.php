<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Acme\Services\Interacts\CacheSearch;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\Adapters\MergeSkyMusic;
use App\Acme\Services\Fetchs\FetchHtmlSearch;
use App\Acme\Services\Extracts\ExtractSearchHtml;
use App\Acme\Services\Adapters\SkymusicLoadSearchData;

class LoadSearchData
{
    private $fetchHtmlSearch;
    private $cacheSearch;
    private $extractSearchHtml;
    private $createSongs;
    private $mergeSkyMusic;
    private $skymusicLoadSearchData;
    private $songModel;

    public function __construct(
        FetchHtmlSearch $fetchHtmlSearch,
        CacheSearch $cacheSearch,
        ExtractSearchHtml $extractSearchHtml,
        CreateSongs $createSongs,
        MergeSkyMusic $mergeSkyMusic,
        SkymusicLoadSearchData $skymusicLoadSearchData,
        NCTSong $songModel
    ) {
        $this->fetchHtmlSearch        = $fetchHtmlSearch;
        $this->cacheSearch            = $cacheSearch;
        $this->extractSearchHtml      = $extractSearchHtml;
        $this->createSongs            = $createSongs;
        $this->mergeSkyMusic          = $mergeSkyMusic;
        $this->skymusicLoadSearchData = $skymusicLoadSearchData;
        $this->songModel              = $songModel;
    }

    public function execute(string $query, int $page)
    {
        if ($songs = $this->cacheSearch->get($query, $page)) {
            return $songs;
        }

        if ( ! $html = $this->fetchHtmlSearch->execute($query, $page)) {
            throw new CrawlSongFailException;
        }

        if ( ! $searchData = $this->extractSearchHtml->execute($html)) {
            throw new ExtractSearchHtmlFailException;
        }

        //$this->skymusicLoadSearchData->execute($query);
        //$searchData = $this->mergeSkyMusic->execute($query, $searchData);

        if ( ! $this->createSongs->execute($searchData)) {
            throw new CreateSongsFailException;
        }

        $array_id = array_column($searchData, 'song_id');
        $song     = $this->songModel->getSongWithRelationBySongIds($array_id);

        return ['results' => $song, 'query' => $query, 'page' => $page];
    }
}
