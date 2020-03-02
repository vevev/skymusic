<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Acme\Services\Interacts\GetSong;
use App\Acme\Services\Interacts\StoreTag;
use App\Exceptions\SongNotFoundException;
use App\Acme\Services\Interacts\CacheSong;
use App\Acme\Services\Interacts\StoreSong;
use App\Exceptions\CrawlSongFailException;
use App\Acme\Services\Fetchs\FetchHtmlSong;
use App\Exceptions\SetRelatesFailException;
use App\Exceptions\UpdateSongFailException;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\Adapters\LoadTop20Song;
use App\Acme\Services\Extracts\ExtractSongHtml;
use App\Exceptions\CreateRelationFailException;
use App\Acme\Services\Interacts\CreateRelations;

class LoadSongData
{
    private $fetchHtmlSong;
    private $getSong;
    private $extractSongHtml;
    private $createSongs;
    private $createRelations;
    private $cacheSong;
    private $storeSong;
    private $storeTag;
    private $loadTop20Song;

    /**
     * Constructs a new instance.
     *
     * @param      \App\Acme\Services\Fetchs\FetchHtmlSong       $fetchHtmlSong    The fetch html song
     * @param      \App\Acme\Services\Interacts\GetSong          $getSong          The get song
     * @param      \App\Acme\Services\Extracts\ExtractSongHtml   $extractSongHtml  The extract song html
     * @param      \App\Acme\Services\Interacts\CreateSongs      $createSongs      The create songs
     * @param      \App\Acme\Services\Interacts\CreateRelations  $createRelations  The create relations
     */
    public function __construct(FetchHtmlSong $fetchHtmlSong, GetSong $getSong, ExtractSongHtml $extractSongHtml, CreateSongs $createSongs, CreateRelations $createRelations, LoadTop20Song $loadTop20Song, CacheSong $cacheSong, StoreSong $storeSong, StoreTag $storeTag)
    {
        $this->fetchHtmlSong   = $fetchHtmlSong;
        $this->getSong         = $getSong;
        $this->extractSongHtml = $extractSongHtml;
        $this->createSongs     = $createSongs;
        $this->createRelations = $createRelations;
        $this->loadTop20Song   = $loadTop20Song;
        $this->cacheSong       = $cacheSong;
        $this->storeSong       = $storeSong;
        $this->storeTag        = $storeTag;
    }

    /**
     * { function_description }
     *
     * @param      string                                 $id     The identifier
     *
     * @throws     \App\Exceptions\SongNotFoundException  (description)
     *
     * @return     <type>                                 ( description_of_the_return_value )
     */
    public function execute(string $id)
    {
        // Neu khong ton tai bai hat thi the throw loi ma khong crawl
        if ( ! $song = $this->getSong->execute($id)) {
            throw new SongNotFoundException;
        }

        // Neu bai hat chua crawl day du hoac het han thi tien hanh crawl va save
        elseif ( ! $song->hasFetched() || $song->expired()) {
            $this->fetchAndSaveSong($song);
            $this->loadRelationAndCache($song);
        }

        if ($this->storeTag->execute($id)) {
            $this->loadRelationAndCache($song);
        }

        return [
            'song'    => $song,
            'sidebar' => [
                'primary' => $this->loadTop20Song->execute('vn', 'bai-hat'),
            ],
        ];
    }

    /**
     * Fetches and save song.
     *
     * @param      NCTSong                                      $song   The song
     *
     * @throws     \App\Exceptions\CrawlSongFailException       (description)
     * @throws     \App\Exceptions\CreateRelationFailException  (description)
     * @throws     \App\Exceptions\SetRelatesFailException      (description)
     * @throws     \App\Exceptions\UpdateSongFailException      (description)
     */
    private function fetchAndSaveSong(NCTSong $song)
    {
        $html                   = $this->fetchHtmlSong->execute($song);
        [$songAttr, $arraySong] = $this->extractSongHtml->execute($html);

        $song->updateOrInsertOption([
            'song_id'     => $song->song_id,
            'canDownload' => $songAttr['canDownload'],
        ]);

        unset($songAttr['canDownload']);

        $this->storeSong->execute($song, $songAttr, $arraySong);
    }

    /**
     * Loads a relation and cache.
     *
     * @param      \App\Models\NCTSong  $song   The song
     *
     * @return     \App\Models\NCTSong  ( description_of_the_return_value )
     */
    private function loadRelationAndCache(NCTSong $song)
    {
        $song->load(['options', 'relates', 'sky', 'tags']);
        $song->relates->load(['listens']);
        $this->cacheSong->set($song);

        return $song;
    }
}
