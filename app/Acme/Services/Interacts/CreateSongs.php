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

    public function execute(array $songs)
    {
        $song_ids = [];
        foreach ($songs as $index => $song) {
            $songs[$song['song_id']] = $song;
            unset($songs[$index]);
            $song_ids[] = $song['song_id'];
        }

        $savedSongs = $this->song->findBySongIds($song_ids);
        if ($savedSongs->count() === count($songs)) {
            return $savedSongs;
        }

        $savedSongs->map(function ($song) use (&$songs) {
            unset($songs[$song->song_id]);
        });

        return $this->song->insert($songs);
    }
}
