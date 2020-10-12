<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;
use Illuminate\Support\Facades\Cache;
use App\Acme\Services\Interacts\CacheSong;

class GetSong
{
    private $song;
    private $cacheSong;
    /**
     * [__construct description]
     *
     * @param      NCTSong                                 $song       [description]
     * @param      \App\Acme\Services\Interacts\CacheSong  $cacheSong  The cache song
     */
    public function __construct(NCTSong $song, CacheSong $cacheSong)
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

        return $this->song->findById($id);
    }
}
