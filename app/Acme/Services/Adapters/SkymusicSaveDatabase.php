<?php

namespace App\Acme\Services\Adapters;

use Illuminate\Support\Facades\Cache;
use App\Acme\Services\Fetchs\FetchSkymusicDatabase;
use App\Acme\Services\Interacts\CacheSearchSkymusic;
use App\Acme\Services\Interacts\CreateSongsSkymusic;
use App\Exceptions\FetchJsonSearchSkymusicException;
use App\Acme\Services\Fetchs\FetchJsonSearchSkyMusic;
use App\Acme\Services\Extracts\ExtractDataSearchSkymusic;

/**
 * This class describes a skymusic save database.
 */
class SkymusicSaveDatabase
{
    private $cache_key = 'fetch_sky_music_database_page_index';
    private $fetchSkymusicDatabase;
    private $createSongsSkymusic;
    private $extractDataSearchSkymusic;

    /**
     * Constructs a new instance.
     *
     * @param      FetchJsonSearchSkyMusic  $fetchSkymusicDatabase      The fetch json search
     *                                                                  skymusic
     * @param      CreateSongsSkymusic      $createSongsSkymusic        The create songs skymusic
     * @param      CacheSearchSkymusic      $extractDataSearchSkymusic  The cache search skymusic
     */
    public function __construct(
        FetchSkymusicDatabase $fetchSkymusicDatabase,
        CreateSongsSkymusic $createSongsSkymusic,
        ExtractDataSearchSkymusic $extractDataSearchSkymusic
    ) {
        $this->fetchSkymusicDatabase     = $fetchSkymusicDatabase;
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
    public function execute(string $query, int $page = 1)
    {
        if (Cache::has($this->cache_key)) {
            $page = Cache::get($this->cache_key) + 1;
        }

        if ( ! $json = $this->fetchSkymusicDatabase->execute($page)) {
            throw new FetchJsonSearchSkymusicException;
        }

        if (isset($json->code)) {
            throw new FetchJsonSearchSkymusicException;
        }

        [$keys, $songs] = $this->extractDataSearchSkymusic->execute($json);

        if ( ! $this->createSongsSkymusic->execute($keys, $songs)) {
            throw new CreateSongsSkymusicException;
        }

        Cache::forever($this->cache_key, $page);

        return ['status' => 'success', 'page' => $page];
    }
}
