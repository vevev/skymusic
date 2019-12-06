<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTPlaylist;
use App\Acme\Services\Interacts\GetSong;
use App\Acme\Services\Fetchs\FetchHtmlSong;
use App\Exceptions\SetRelatesFailException;
use App\Exceptions\UpdateSongFailException;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\Interacts\GetPlaylist;
use App\Acme\Services\Adapters\LoadTop20Song;
use App\Exceptions\PlaylistNotFoundException;
use App\Exceptions\CrawlPlaylistFailException;
use App\Acme\Services\Fetchs\FetchHtmlPlaylist;
use App\Exceptions\CreateRelationFailException;
use App\Acme\Services\Interacts\CreateRelations;
use App\Acme\Services\Extracts\ExtractPlaylistHtml;

class LoadPlaylistData
{
    private $fetchHtmlPlaylist;
    private $getPlaylist;
    private $extractPlaylistHtml;
    private $createSongs;
    private $createRelations;
    private $loadTop20Song;

    /**
     * Constructs a new instance.
     *
     * @param      \App\Acme\Services\Fetchs\FetchHtmlSong       $fetchHtmlPlaylist  The fetch html
     *                                                                               song
     * @param      \App\Acme\Services\Interacts\GetSong          $getPlaylist        The get song
     * @param      \App\Acme\Services\Extracts\ExtractPlaylistHtml   $extractPlaylistHtml    The extract song html
     * @param      \App\Acme\Services\Interacts\CreateSongs      $createSongs        The create songs
     * @param      \App\Acme\Services\Interacts\CreateRelations  $createRelations    The create relations
     * @param      \App\Acme\Services\Adapters\LoadTop20Song     $loadTop20Song      The load top 20 song
     */
    public function __construct(FetchHtmlPlaylist $fetchHtmlPlaylist, GetPlaylist $getPlaylist, ExtractPlaylistHtml $extractPlaylistHtml, CreateSongs $createSongs, CreateRelations $createRelations, LoadTop20Song $loadTop20Song)
    {
        $this->fetchHtmlPlaylist   = $fetchHtmlPlaylist;
        $this->getPlaylist         = $getPlaylist;
        $this->extractPlaylistHtml = $extractPlaylistHtml;
        $this->createSongs         = $createSongs;
        $this->createRelations     = $createRelations;
        $this->loadTop20Song       = $loadTop20Song;
    }

    /**
     * { function_description }
     *
     * @param      string                                 $id     The identifier
     *
     * @throws     \App\Exceptions\PlaylistNotFoundException  (description)
     *
     * @return     <type>                                 ( description_of_the_return_value )
     */
    public function execute(string $id)
    {
        $playlist = $this->getPlaylist->execute($id);

        if ( ! $playlist) {
            throw new PlaylistNotFoundException;
        }

        if ( ! $playlist->hasFetched()) {
            $this->fetchAndSavePlaylist($playlist);
        }

        $playlist->load(['sky'])->relates->load('listens');

        return [
            'playlist' => $playlist,
            'sidebar'  => [
                'primary' => $this->loadTop20Song->execute('vn', 'bai-hat'),
            ],
        ];
    }

    /**
     * Fetches and save song.
     *
     * @param      NCTPlaylist                                      $playlist   The song
     *
     * @throws     \App\Exceptions\CrawlSongFailException       (description)
     * @throws     \App\Exceptions\CreateRelationFailException  (description)
     * @throws     \App\Exceptions\SetRelatesFailException      (description)
     * @throws     \App\Exceptions\UpdateSongFailException      (description)
     */
    private function fetchAndSavePlaylist(NCTPlaylist $playlist)
    {
        $html = $this->fetchHtmlPlaylist->execute($playlist);

        $data = $this->extractPlaylistHtml->execute($html);
        if ( ! is_array($data)) {
            throw new CrawlPlaylistFailException;
        }

        [$_song, $_songs] = $data;
        if ( ! $playlist->fill($_song)->save()) {
            throw new UpdateSongFailException;
        }

        if ( ! $this->createSongs->execute($_songs)) {
            throw new SetRelatesFailException;
        }

        if ( ! $this->createRelations->execute($playlist, $_songs)) {
            throw new CreateRelationFailException;
        }

        $playlist->load('relates');
    }
}
