<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;

class CacheSearch
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

    public function get(string $query, int $page) {}

    public function set(string $query, int $page) {}
}
