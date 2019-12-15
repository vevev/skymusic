<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTPlaylist;
use App\Acme\Services\Fetchs\FetchHtmlTopics;
use App\Acme\Services\Interacts\CreatePlaylists;
use App\Acme\Services\Extracts\ExtractTopicsHtml;

class LoadTopicsData
{
    private $fetchHtmlTopics;
    private $extractTopicsHtml;
    private $playlist;
    private $createPlaylists;

    public function __construct(FetchHtmlTopics $fetchHtmlTopics, ExtractTopicsHtml $extractTopicsHtml, NCTPlaylist $playlist, CreatePlaylists $createPlaylists)
    {

        $this->fetchHtmlTopics   = $fetchHtmlTopics;
        $this->extractTopicsHtml = $extractTopicsHtml;
        $this->playlist          = $playlist;
        $this->createPlaylists   = $createPlaylists;
    }

    /**
     * { function_description }
     *
     * @param  string                                    $id             The identifier
     * @throws \App\Exceptions\PlaylistNotFoundException (description)
     * @return <type>                                    ( description_of_the_return_value )
     */
    public function execute(string $slug, int $page = 1)
    {
        $html      = $this->fetchHtmlTopics->execute($slug, $page);
        $playlists = $this->extractTopicsHtml->execute($html);

        if ( ! is_array($playlists)) {
            throw new CrawlPlaylistFailException;
        }

        if ( ! $playlists = $this->createPlaylists->execute($playlists, true)) {
            throw new CreatePlaylistsFailException;
        }

        dd($playlists);
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
