<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Models\NCTListen;
use App\Acme\Services\Fetchs\FetchJsonListen;

class CrawlListen
{
    private $songModel;
    private $fetchJsonListen;
    private $listenModel;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(NCTSong $songModel, FetchJsonListen $fetchJsonListen, NCTListen $listenModel)
    {
        $this->songModel       = $songModel;
        $this->fetchJsonListen = $fetchJsonListen;
        $this->listenModel     = $listenModel;
    }

    public function execute()
    {
        $arrayRealIds = $this->songModel
                             ->getSongWithListenIsNull(50, ['nct_songs.real_id'])
                             ->pluck('real_id')
                             ->toArray();
        $arrayListen = $this->fetchJsonListen->execute($arrayRealIds);

        if ( ! $arrayListen) {
            return;
        }

        $insert = [];
        foreach ($arrayListen as $id => $listen) {
            $insert[] = ['real_id' => $id, 'listen' => $listen, 'type' => 'song'];
        }

        $fakeListen = -(date('dmY'));
        foreach ($arrayRealIds as $id) {
            if ( ! isset($arrayListen->{$id})) {
                $insert[] = ['real_id' => $id, 'listen' => $fakeListen, 'type' => 'song'];
            }
        }

        $this->listenModel->insert($insert);
    }
}
