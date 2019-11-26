<?php

namespace App\Acme\Services\Interacts;

use App\Models\SKYMUSIC_Song;

class CacheSearchSkymusic
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

    public function get(string $query, int $page) {}

    public function set(string $query, int $page) {}
}
