<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Adapters\LoadTop20Song;
use App\Acme\Services\Interacts\GetSongSkyMusic;
use App\Exceptions\SongSkymusicNotFoundException;
use App\Acme\Services\Interacts\CacheSkymusicSong;

class LoadSongSkymusicData
{
    private $getSong;
    private $cacheSkymusicSong;
    private $loadTop20Song;

    public function __construct(GetSongSkyMusic $getSong, LoadTop20Song $loadTop20Song, CacheSkymusicSong $cacheSkymusicSong)
    {
        $this->getSong           = $getSong;
        $this->loadTop20Song     = $loadTop20Song;
        $this->cacheSkymusicSong = $cacheSkymusicSong;
    }

    public function execute(string $id)
    {
        $song = $this->getSong->execute($id);
        if ( ! $song) {
            throw new SongSkymusicNotFoundException;
        }

        if ( ! $song->cached) {
            $song->load(['song', 'listens']);
            $song->relates->load('listens');
            $this->cacheSkymusicSong->set($song);
        }

        return [
            'song'    => $song,
            'sidebar' => [
                'primary' => $this->loadTop20Song->execute('vn', 'bai-hat'),
            ],
        ];
    }
}
