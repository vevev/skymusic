<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Models\NCTListen;
use App\Models\NCTPlaylist;
use App\Acme\Services\Fetchs\FetchJsonListen;

class CrawlListen
{
    private $songModel;
    private $fetchJsonListen;
    private $listenModel;
    private $playlistModel;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(NCTSong $songModel, FetchJsonListen $fetchJsonListen, NCTListen $listenModel, NCTPlaylist $playlistModel)
    {
        $this->songModel       = $songModel;
        $this->fetchJsonListen = $fetchJsonListen;
        $this->listenModel     = $listenModel;
        $this->playlistModel   = $playlistModel;
    }

    public function execute()
    {
        $arrayRealIds = $this->songModel
                             ->getSongWithListenIsNull(50, ['nct_songs.real_id'])
                             ->pluck('real_id')
                             ->toArray();

        $arrayPlaylistRealIds = $this->playlistModel
                                     ->getPlaylistWithListenIsNull(50, ['nct_playlists.real_id'])
        ;

        return view(\Core::viewPath('error'));
        $arrayListen = $this->fetchJsonListen->execute($arrayRealIds);

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
