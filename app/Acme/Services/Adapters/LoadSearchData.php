<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Exceptions\CrawlSearchException;
use App\Acme\Services\Interacts\CacheSearch;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\Adapters\MergeSkyMusic;
use App\Acme\Services\Fetchs\FetchHtmlSearch;
use App\Exceptions\ExtractSearchHtmlException;
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

        if ($results = $this->fetchResult($query, $page)) {
            if ($songs = $this->createSongs->execute($results, true)) {
                $results = $songs->load('listens');
            } else {
                throw new CreateSongsFailException;
            }
        }

        return [
            'results' => $results,
            'query'   => $query,
            'page'    => $page,
        ];
    }

    /**
     * Fetches a result.
     *
     * @param      string                                $query  The query
     * @param      integer                               $page   The page
     *
     * @throws     ExtractSearchHtmlFailException        (description)
     * @throws     \App\Exceptions\CrawlSearchException  (description)
     */
    private function fetchResult(string $query, int $page)
    {
        if ( ! $html = $this->fetchHtmlSearch->execute($query, $page)) {
            throw new CrawlSearchException;
        }

        // ...
        if ('NO_RESULT' === $html) {
            return [];
        }

        // ..
        elseif ( ! $searchData = $this->extractSearchHtml->execute($html)) {
            throw new ExtractSearchHtmlException;
        }

        // moi chuyen ok thi return results
        else {
            return $searchData;
        }
    }
}
