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
        $songs = collect($songs);

        $song_ids = $songs->pluck('song_id')->toArray();

        $savedSongs = $this->song->findBySongIds($song_ids);

        if ($savedSongs->count() === count($songs)) {
            return $savedSongs->sortBy(function ($song) use ($song_ids) {
                return array_search($song->song_id, $song_ids);
            })->values();
        }

        $savedSongs->map(function ($song) use (&$songs) {
            unset($songs[$song->song_id]);
        });

        if ( ! $this->song->insert($songs)) {
            return false;
        }

        if ($returnModels) {
            return $this->song
                        ->findBySongIds($song_ids)
                        ->sortBy(function ($song) use ($song_ids) {
                            return array_search($song->song_id, $song_ids);
                        })->values();
        }

        return true;
    }
}
