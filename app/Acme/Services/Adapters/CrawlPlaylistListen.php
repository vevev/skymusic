<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTListen;
use App\Models\NCTPlaylist;
use App\Acme\Services\Fetchs\FetchJsonListen;

class CrawlPLaylistListen
{
    private $playlistModel;
    private $fetchJsonListen;
    private $listenModel;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(NCTPlaylist $playlistModel, FetchJsonListen $fetchJsonListen, NCTListen $listenModel)
    {
        $this->playlistModel   = $playlistModel;
        $this->fetchJsonListen = $fetchJsonListen;
        $this->listenModel     = $listenModel;
    }

    public function execute()
    {
        $arrayRealIds = $this->playlistModel
                             ->getPlaylistWithListenIsNull(50, ['nct_playlists.real_id'])
                             ->pluck('real_id')
                             ->toArray();
        $arrayListen = $this->fetchJsonPlaylistListen->execute($arrayRealIds);

        if ( ! $arrayListen) {
            return;
        }

        $insert = [];
        foreach ($arrayListen as $index => $listen) {
            $insert[] = ['real_id' => $index, 'listen' => $listen, 'type' => 'song'];
        }

        $this->listenModel->insert($insert);
    }
}
