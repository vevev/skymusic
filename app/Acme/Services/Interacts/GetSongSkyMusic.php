<?php

namespace App\Acme\Services\Interacts;

use App\Models\SKYMUSIC_Song;
use Illuminate\Support\Facades\Cache;

class GetSongSkyMusic
{
    private $song;
    /**
     * [__construct description]
     *
     * @param SKYMUSIC_Song $song [description]
     */
    public function __construct(SKYMUSIC_Song $song)
    {
        $this->song = $song;
    }

    public function execute(string $id)
    {
        if ($song = Cache::store('redis')->get($id)) {
            $song->cached = true;

            return $song;
        }

        if ($song = $this->song->findByKey($id)) {
            return $song;
        }
    }
}
