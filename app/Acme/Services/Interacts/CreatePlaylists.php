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
        $playlist_ids = array_column($playlists, 'song_id');

        $savedSongs = $this->song->findBySongIdsWithOrder($playlist_ids);

        if ($savedSongs->count() === count($songs)) {
            return $savedSongs;
        }

        foreach ($savedSongs as $song) {
            unset($songs[array_search($song->song_id, $playlist_ids)]);
        }

        if ( ! $this->song->insert($songs)) {
            return false;
        }

        if ($returnModels) {
            return $this->song->findBySongIdsWithOrder($playlist_ids);
        }

        return true;
    }
}
