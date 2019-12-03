<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Interacts\CacheBXH;
use App\Acme\Services\Fetchs\FetchTop20Song;
use App\Acme\Services\Interacts\CreateSongs;
use App\Exceptions\CrawlTop20SongFailException;
use App\Acme\Services\Extracts\ExtractTop20Song;
use App\Exceptions\ExtractTop20SongFailException;

class LoadTop20Song
{
    private $fetchTop20Song;
    private $cacheBXH;
    private $extractTop20Song;
    private $createSongs;
    private $mergeSkyMusic;
    private $skymusicLoadSearchData;

    public function __construct(
        FetchTop20Song $fetchTop20Song,
        CacheBXH $cacheBXH,
        ExtractTop20Song $extractTop20Song,
        CreateSongs $createSongs
    ) {
        $this->fetchTop20Song   = $fetchTop20Song;
        $this->cacheBXH         = $cacheBXH;
        $this->extractTop20Song = $extractTop20Song;
        $this->createSongs      = $createSongs;
    }

    public function execute(string $country = 'vn', string $type = 'bai-hat', bool $renewCache = false)
    {
        if ( ! $renewCache) {
            return $this->cacheBXH->get($country, $type);
        }

        if ( ! $html = $this->fetchTop20Song->execute($country, $type)) {
            throw new CrawlTop20SongFailException;
        }

        if ( ! $searchData = $this->extractTop20Song->execute($html)) {
            throw new ExtractTop20SongFailException;
        }

        if ( ! $this->createSongs->execute($searchData)) {
            throw new CreateSongsFailException;
        }

        $this->cacheBXH->set($country, $type, $searchData);
    }
}
