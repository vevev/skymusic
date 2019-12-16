<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTPlaylist;
use App\Acme\Services\Interacts\GetSong;
use App\Acme\Services\Fetchs\FetchHtmlSong;
use App\Exceptions\UpdateSongFailException;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\Interacts\GetPlaylist;
use App\Acme\Services\Adapters\LoadTop20Song;
use App\Exceptions\PlaylistNotFoundException;
use App\Acme\Services\Interacts\CachePlaylist;
use App\Exceptions\CreateSongsFailedException;
use App\Acme\Services\Fetchs\FetchHtmlPlaylist;
use App\Acme\Services\Interacts\CreateRelations;
use App\Acme\Services\Fetchs\FetchSongOfPlaylist;
use App\Acme\Services\Extracts\ExtractPlaylistHtml;
use App\Acme\Services\Extracts\ExtractPlaylistSongs;
use App\Acme\Services\Interacts\CreatePlaylistSongRelations;
use App\Exceptions\CreatePlaylistSongRelationsFailedException;

class LoadPlaylistData
{
    private $fetchHtmlPlaylist;
    private $getPlaylist;
    private $extractPlaylistHtml;
    private $createSongs;
    private $createRelations;
    private $fetchSongOfPlaylist;
    private $extractPlaylistSongs;
    private $createPlaylistSongRelations;
    private $cachePlaylist;
    private $loadTop20Song;

    /**
     * Constructs a new instance.
     *
     *                                                                               song
     * @param \App\Acme\Services\Fetchs\FetchHtmlSong         $fetchHtmlPlaylist   The fetch html
     * @param \App\Acme\Services\Interacts\GetSong            $getPlaylist         The get song
     * @param \App\Acme\Services\Extracts\ExtractPlaylistHtml $extractPlaylistHtml The extract song html
     * @param \App\Acme\Services\Interacts\CreateSongs        $createSongs         The create songs
     * @param \App\Acme\Services\Interacts\CreateRelations    $createRelations     The create relations
     * @param \App\Acme\Services\Adapters\LoadTop20Song       $loadTop20Song       The load top 20 song
     */
    public function __construct(
        FetchHtmlPlaylist $fetchHtmlPlaylist,
        GetPlaylist $getPlaylist,
        ExtractPlaylistHtml $extractPlaylistHtml,
        CreateSongs $createSongs,
        CreateRelations $createRelations,
        LoadTop20Song $loadTop20Song,
        FetchSongOfPlaylist $fetchSongOfPlaylist,
        ExtractPlaylistSongs $extractPlaylistSongs,
        CreatePlaylistSongRelations $createPlaylistSongRelations,
        CachePlaylist $cachePlaylist
    ) {
        $this->fetchHtmlPlaylist           = $fetchHtmlPlaylist;
        $this->getPlaylist                 = $getPlaylist;
        $this->extractPlaylistHtml         = $extractPlaylistHtml;
        $this->createSongs                 = $createSongs;
        $this->createRelations             = $createRelations;
        $this->loadTop20Song               = $loadTop20Song;
        $this->fetchSongOfPlaylist         = $fetchSongOfPlaylist;
        $this->extractPlaylistSongs        = $extractPlaylistSongs;
        $this->createPlaylistSongRelations = $createPlaylistSongRelations;
        $this->cachePlaylist               = $cachePlaylist;
    }

    /**
     * { function_description }
     *
     * @param  string                                    $id             The identifier
     * @throws \App\Exceptions\PlaylistNotFoundException (description)
     * @return <type>                                    ( description_of_the_return_value )
     */
    public function execute(string $id)
    {
        $playlist = $this->getPlaylist->execute($id);

        // Nếu không tồn tại playlist thì throw lỗi mà không fetch playlist theo id truyền
        // vào tránh bị bọn nó chơi xấu
        if ( ! $playlist) {
            throw new PlaylistNotFoundException;
        }

        // Trong trường hợp key bị thiếu thì ta sẽ cập nhật key cho playlist
        if ( ! $playlist->key && ! $this->fetchAndSavePlaylist($playlist)) {
            throw new FetchPlaylistFailedException;
        }

        // Nếu như không có danh sách bài hát thì cập nhật fetch danh sách bài hát cho playlist
        if ( ! $playlist->songs->count() && ! $this->fetchAndSaveSong($playlist)) {
            throw new FetchSongOfPlaylistFailedException;
        }

        // Nếu playlist chưa được cache thì thực hiện load listens cho danh sách bài hát
        // và cache lại
        if ( ! $playlist->cached) {
            $playlist->load('songs');
            $playlist->songs->load('listens');
            $this->cachePlaylist->set($playlist);
        }

        return [
            'playlist' => $playlist,
            'sidebar'  => [
                'primary' => $this->loadTop20Song->execute('vn', 'bai-hat'),
            ],
        ];
    }

    /**
     * Fetches and save playlist.
     *
     * @param  \App\Models\NCTPlaylist                 $playlist       The playlist
     * @throws CrawlPlaylistFailException              (description)
     * @throws \App\Exceptions\UpdateSongFailException (description)
     * @return boolean                                 And save playlist.
     */
    private function fetchAndSavePlaylist(NCTPlaylist $playlist)
    {
        $html = $this->fetchHtmlPlaylist->execute($playlist);

        $playlist_array = $this->extractPlaylistHtml->execute($html);
        if ( ! is_array($playlist_array)) {
            throw new CrawlPlaylistFailException;
        }

        if ( ! $playlist->fill($playlist_array)->save()) {
            throw new UpdateSongFailException;
        }

        return true;
    }

    /**
     * Fetches and save song.
     *
     * @param  NCTPlaylist                                $playlist       The playlist
     * @throws CrawlSongOfPlaylistFailedException         (description)
     * @throws CreatePlaylistSongRelationsFailedException (description)
     * @throws CreateSongsFailedException                 (description)
     */
    private function fetchAndSaveSong(NCTPlaylist $playlist)
    {
        if ( ! $array_song = $this->fetchSongOfPlaylist->execute($playlist)) {
            throw new CrawlSongOfPlaylistFailedException;
        }

        $songs = $this->extractPlaylistSongs->execute($array_song);

        if ( ! is_array($songs)) {
            throw new CrawlSongOfPlaylistFailedException;
        }

        if ( ! $this->createSongs->execute($songs)) {
            throw new CreateSongsFailedException;
        }

        if ( ! $this->createPlaylistSongRelations->execute($playlist, $songs)) {
            throw new CreatePlaylistSongRelationsFailedException;
        }

        return true;
    }
}
