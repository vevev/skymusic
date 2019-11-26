<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Interacts\CacheSearchSkymusic;
use App\Acme\Services\Interacts\CreateSongsSkymusic;
use App\Acme\Services\Fetchs\FetchJsonSearchSkyMusic;

class SkymusicLoadSearchData
{
    private $cacheSearchSkymusic;
    private $fetchJsonSearchSkymusic;
    private $createSongsSkymusic;

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
        CreateSongsSkymusic $createSongsSkymusic
    ) {
        $this->cacheSearchSkymusic     = $cacheSearchSkymusic;
        $this->fetchJsonSearchSkymusic = $fetchJsonSearchSkymusic;
        $this->createSongsSkymusic     = $createSongsSkymusic;
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
    public function execute(string $query, int $page)
    {

        if ($songs = $this->cacheSearchSkymusic->get($query, $page)) {
            return $songs;
        }

        if ( ! $json = $this->fetchJsonSearchSkymusic->execute($query, $page)) {
            throw new FetchJsonSearchSkymusicException;
        }

        if ( ! isset($json->code) && ! $this->createSongsSkymusic->execute($json)) {
            throw new CreateSongsSkymusicException;
        }

        return ['results' => $json, 'query' => $query, 'page' => $page];
    }
}
