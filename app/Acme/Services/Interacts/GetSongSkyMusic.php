<?php

namespace App\Acme\Services\Interacts;

use App\Models\SKYMUSIC_Song;
use App\Acme\Services\Interacts\CacheSkymusicSong;

class GetSongSkyMusic
{
    private $song;
    private $cacheSong;
    /**
     * [__construct description]
     *
     * @param SKYMUSIC_Song $song [description]
     */
    public function __construct(SKYMUSIC_Song $song, CacheSkymusicSong $cacheSong)
    {
        $this->song      = $song;
        $this->cacheSong = $cacheSong;
    }

    public function execute(string $id)
    {
        if ($song = $this->cacheSong->get($id)) {
            $song->cached = true;

            return $song;
        }

        if ($song = $this->song->findByKey($id)) {
            return $song;
        }
    }
}
