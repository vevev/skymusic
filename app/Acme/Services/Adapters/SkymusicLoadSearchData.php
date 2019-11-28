<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Interacts\CacheSearchSkymusic;
use App\Acme\Services\Interacts\CreateSongsSkymusic;
use App\Exceptions\FetchJsonSearchSkymusicException;
use App\Acme\Services\Fetchs\FetchJsonSearchSkyMusic;
use App\Acme\Services\Extracts\ExtractDataSearchSkymusic;

class SkymusicLoadSearchData
{
    private $cacheSearchSkymusic;
    private $fetchJsonSearchSkymusic;
    private $createSongsSkymusic;
    private $extractDataSearchSkymusic;

    /**
     * Constructs a new instance.
     *
     * @param CacheSearchSkymusic       $cacheSearchSkymusic The cache search skymusic
     *
     * @param FetchJsonSearchSkyMusic   $fetchJsonSearchSkymusic The fetch json search skymusic
     *
     * @param CreateSongsSkymusic       $createSongsSkymusic The create songs skymusic
     */
    public function __construct(
        CacheSearchSkymusic $cacheSearchSkymusic,
        FetchJsonSearchSkyMusic $fetchJsonSearchSkymusic,
        CreateSongsSkymusic $createSongsSkymusic,
        ExtractDataSearchSkymusic $extractDataSearchSkymusic
    ) {
        $this->cacheSearchSkymusic       = $cacheSearchSkymusic;
        $this->fetchJsonSearchSkymusic   = $fetchJsonSearchSkymusic;
        $this->createSongsSkymusic       = $createSongsSkymusic;
        $this->extractDataSearchSkymusic = $extractDataSearchSkymusic;
    }

    /**
     * Thuc thi viec lay du lieu tim kiem tu api skymusic
     *
     * @param      string                            $query  Tu Khoa tim kiem
     * @param      integer                           $page   So trang
     *
     * @throws     CreateSongsSkymusicException
     * @throws     FetchJsonSearchSkymusicException
     *
     * @return     array
     */
    public function execute(string $query, int $page = 0)
    {
        if ($songs = $this->cacheSearchSkymusic->get($query, $page)) {
            return $songs;
        }

        if ( ! $json = $this->fetchJsonSearchSkymusic->execute($query, $page)) {
            throw new FetchJsonSearchSkymusicException;
        }

        if (isset($json->code)) {
            throw new FetchJsonSearchSkymusicException;
        }

        [$keys, $songs] = $this->extractDataSearchSkymusic->execute($json);

        if ( ! $this->createSongsSkymusic->execute($keys, $songs)) {
            throw new CreateSongsSkymusicException;
        }

        return ['results' => $songs, 'query' => $query, 'page' => $page];
    }
}
