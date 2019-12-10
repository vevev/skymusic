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

        $collect_song_ids = $songs->pluck('song_id');
        $array_song_ids   = $collect_song_ids->toArray();

        $savedSongs = $this->song->findBySongIds($array_song_ids);

        if ($savedSongs->count() === count($songs)) {
            return $savedSongs->sortBy(function ($song) use ($array_song_ids) {
                return array_search($song->song_id, $array_song_ids);
            })->values();
        }

        $keys = $savedSongs->map(function ($song) use ($array_song_ids) {
            return array_search($song->song_id, $array_song_ids);
        })->map(function ($key) use (&$songs) {
            $songs->forget($key);
        });

        if ( ! $this->song->insert($songs->toArray())) {
            return false;
        }

        if ($returnModels) {
            return $this->song
                        ->findBySongIds($array_song_ids)
                        ->sortBy(function ($song) use ($array_song_ids) {
                            return array_search($song->song_id, $array_song_ids);
                        })->values();
        }

        return true;
    }
}
