<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTPlaylist;

class CreatePlaylists
{
    private $playlist;
    /**
     * [__construct description]
     *
     * @param NCTPlaylist $playlist [description]
     */
    public function __construct(NCTPlaylist $playlist)
    {
        $this->playlist = $playlist;
    }

    /**
     * { function_description }
     *
     * @param      array   $playlists  The playlists
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function execute(array $playlists, bool $returnModels = false)
    {
        $playlist_ids = [];
        foreach ($playlists as $index => $playlist) {
            $playlists[$playlist['playlist_id']] = $playlist;
            unset($playlists[$index]);
            $playlist_ids[] = $playlist['playlist_id'];
        }

        $savedSongs = $this->playlist->findByPlaylistIds($playlist_ids);
        if ($savedSongs->count() === count($playlists)) {
            return $savedSongs;
        }

        $savedSongs->map(function ($playlist) use (&$playlists) {
            unset($playlists[$playlist->playlist_id]);
        });

        if ( ! $this->playlist->insert($playlists)) {
            return false;
        }

        if ($returnModels) {
            return $this->playlist->findByPlaylistIds($playlist_ids);
        }

        return true;
    }
}
