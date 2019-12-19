<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Adapters\LoadTop20Song;
use App\Acme\Services\Interacts\GetSongSkyMusic;
use App\Exceptions\SongSkymusicNotFoundException;

class LoadSongSkymusicData
{
    private $getSong;
    private $loadTop20Song;

    public function __construct(GetSongSkyMusic $getSong, LoadTop20Song $loadTop20Song)
    {
        $this->getSong       = $getSong;
        $this->loadTop20Song = $loadTop20Song;
    }

    public function execute(string $id)
    {
        $song = $this->getSong->execute($id);
        if ( ! $song) {
            throw new SongSkymusicNotFoundException;
        }

        return [
            'song'    => $song,
            'sidebar' => [
                'primary' => $this->loadTop20Song->execute('vn', 'bai-hat'),
            ],
        ];
    }
}
