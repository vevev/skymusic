<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;

class CreateSongs
{
    private $song;
    /**
     * [__construct description]
     *
     * @param NCTSong $song [description]
     */
    public function __construct(NCTSong $song)
    {
        $this->song = $song;
    }

    /**
     * { function_description }
     *
     * @param      array   $songs  The songs
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function execute(array $songs, bool $returnModels = false)
    {
        $song_ids = array_column($songs, 'song_id');

        $savedSongs = $this->song->findBySongIdsWithOrder($song_ids);

        if ($savedSongs->count() === count($songs)) {
            return $savedSongs;
        }

        foreach ($savedSongs as $song) {
            unset($songs[array_search($song->song_id, $song_ids)]);
        }

        if ( ! $this->song->insert($songs)) {
            return false;
        }

        if ($returnModels) {
            return $this->song->findBySongIdsWithOrder($song_ids);
        }

        return true;
    }
}
