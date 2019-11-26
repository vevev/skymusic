<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Interacts\GetSongSkyMusic;
use App\Exceptions\SongSkymusicNotFoundException;

class LoadSongSkymusicData
{
    private $getSong;

    public function __construct(GetSongSkyMusic $getSong)
    {
        $this->getSong = $getSong;
    }

    public function execute(string $id)
    {
        $song = $this->getSong->execute($id);
        if ( ! $song) {
            throw new SongSkymusicNotFoundException;
        }

        return $song;
    }
}
