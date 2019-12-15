<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Acme\Services\Interacts\GetSong;
use App\Exceptions\SongNotFoundException;
use App\Acme\Services\Interacts\CacheSong;
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
    public function __construct(FetchHtmlSong $fetchHtmlSong, GetSong $getSong, ExtractSongHtml $extractSongHtml, CreateSongs $createSongs, CreateRelations $createRelations, LoadTop20Song $loadTop20Song, CacheSong $cacheSong)
    {
        $this->fetchHtmlSong   = $fetchHtmlSong;
        $this->getSong         = $getSong;
        $this->extractSongHtml = $extractSongHtml;
        $this->createSongs     = $createSongs;
        $this->createRelations = $createRelations;
        $this->loadTop20Song   = $loadTop20Song;
        $this->cacheSong       = $cacheSong;
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
        $song = $this->getSong->execute($id);
        if ( ! $song) {
            throw new SongNotFoundException;
        }

        // Neu bai hat da crawl thi tra lai
        elseif ( ! $song->hasFetched()) {
            $this->fetchAndSaveSong($song);
        }

        if ( ! $song->cached) {
            $song->loadCount(['sky'])->relates->load('listens');
            $this->cacheSong->set($song);
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
        $html = $this->fetchHtmlSong->execute($song);

        $data = $this->extractSongHtml->execute($html);
        if ( ! is_array($data)) {
            throw new CrawlSongFailException;
        }

        [$_song, $_songs] = $data;
        if ( ! $song->fill($_song)->save()) {
            throw new UpdateSongFailException;
        }

        if ( ! $this->createSongs->execute($_songs)) {
            throw new SetRelatesFailException;
        }

        if ( ! $this->createRelations->execute($song, $_songs)) {
            throw new CreateRelationFailException;
        }

        $song->load('relates');
    }
}
