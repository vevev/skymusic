<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Interacts\GetPlaylist;
use App\Acme\Services\Adapters\LoadTop20Song;

class LoadIndexData
{
    private $getPlaylist;

    private $loadTop20Song;

    public function __construct(LoadTop20Song $loadTop20Song, GetPlaylist $getPlaylist)
    {
        $this->loadTop20Song = $loadTop20Song;
        $this->getPlaylist   = $getPlaylist;
    }

    public function execute()
    {
        $main           = $this->loadTop20Song->execute('vn', 'bai-hat');
        $playlist_songs = $this->getPlaylist->execute('iZ7XNosoPhJN')->songs;

        return [
            'main'    => $main,
            'sidebar' => [
                //'primary'   => $this->loadTop20Song->execute('us', 'bai-hat'),
                //'secondary' => $this->loadTop20Song->execute('kr', 'bai-hat'),
                'playlist' => $playlist_songs,
            ],
        ];
    }
}
