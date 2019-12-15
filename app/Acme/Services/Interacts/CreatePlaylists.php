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
        $playlist_ids = array_column($playlists, 'playlist_id');

        $savedPlaylists = $this->playlist->findByPlaylistIdsWithOrder($playlist_ids);

        if ($savedPlaylists->count() === count($playlists)) {
            return $savedPlaylists;
        }

        foreach ($savedPlaylists as $playlist) {
            unset($playlists[array_search($playlist->playlist_id, $playlist_ids)]);
        }

        if ( ! $this->playlist->insert($playlists)) {
            return false;
        }

        if ($returnModels) {
            return $this->playlist->findByPlaylistIdsWithOrder($playlist_ids);
        }

        return true;
    }
}
