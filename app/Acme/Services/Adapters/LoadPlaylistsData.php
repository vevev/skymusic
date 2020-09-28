<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTPlaylist;
use App\Acme\Services\Fetchs\FetchHtmlPlaylists;
use App\Acme\Services\Interacts\CreatePlaylists;
use App\Acme\Services\Extracts\ExtractPlaylistsHtml;

class LoadPlaylistsData
{
    private $fetchHtmlPlaylists;
    private $extractPlaylistsHtml;
    private $playlist;
    private $createPlaylists;

    public function __construct(FetchHtmlPlaylists $fetchHtmlPlaylists, ExtractPlaylistsHtml $extractPlaylistsHtml, NCTPlaylist $playlist, CreatePlaylists $createPlaylists)
    {

        $this->fetchHtmlPlaylists   = $fetchHtmlPlaylists;
        $this->extractPlaylistsHtml = $extractPlaylistsHtml;
        $this->playlist             = $playlist;
        $this->createPlaylists      = $createPlaylists;
    }

    /**
     * { function_description }
     *
     * @param      int                                        $page   The page
     * @param      string  $id     The identifier
     *
     * @throws     \App\Exceptions\PlaylistNotFoundException  (description)
     * @throws     CreatePlaylistsFailException               (description)
     *
     * @return     array                                     ( description_of_the_return_value )
     */
    public function execute(int $page = 1)
    {
        $html = $this->fetchHtmlPlaylists->execute($page);

        $playlists = $this->extractPlaylistsHtml->execute($html);
        if ( ! is_array($playlists)) {
            throw new CrawlPlaylistFailException;
        }

        if ( ! $playlists = $this->createPlaylists->execute($playlists, true)) {
            throw new CreatePlaylistsFailException;
        }

        return $playlists;
    }

    /**
     * Fetches and save song.
     *
     * @param  NCTPlaylist                                 $playlist       The song
     * @throws \App\Exceptions\CrawlSongFailException      (description)
     * @throws \App\Exceptions\CreateRelationFailException (description)
     * @throws \App\Exceptions\SetRelatesFailException     (description)
     * @throws \App\Exceptions\UpdateSongFailException     (description)
     */
    private function fetchAndSavePlaylist(NCTPlaylist $playlist)
    {
        $html = $this->fetchHtmlPlaylist->execute($playlist);

        $playlists = $this->extractPlaylistHtml->execute($html);
        if ( ! is_array($data)) {
            throw new CrawlPlaylistFailException;
        }

        if ( ! $playlist->fill($playlists)->save()) {
            throw new UpdateSongFailException;
        }

        if ( ! $this->createSongs->execute($_songs)) {
            throw new CreateSongsFailException;
        }

        if ( ! $this->createRelations->execute($playlist, $_songs)) {
            throw new CreateRelationFailException;
        }

        $playlist->load('relates');
    }
}
