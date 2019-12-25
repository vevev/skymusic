<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use Illuminate\Support\Facades\Cache;
use App\Acme\Services\Interacts\GetPlaylist;
use App\Acme\Services\Adapters\LoadTop20Song;

class LoadIndexData
{
    private $getPlaylist;
    private $songModel;

    private $loadTop20Song;

    public function __construct(LoadTop20Song $loadTop20Song, GetPlaylist $getPlaylist, NCTSong $songModel)
    {
        $this->loadTop20Song = $loadTop20Song;
        $this->getPlaylist   = $getPlaylist;
        $this->songModel     = $songModel;
    }

    public function execute()
    {
        //$main           = $this->loadTop20Song->execute('vn', 'bai-hat');
        //$playlist_songs = $this->getPlaylist->execute('iZ7XNosoPhJN')->songs;
        $main = $this->getSongs('index_main_songs', ["OfxivlPraYwi", "mlnzEWoupew1", "3n5chYI99Lts", "tnvcYCYt7lmv", "iGFAaIkxyXe3", "dM7OTqcZfFgc", "UGn25z66rCyd", "vtEybe9NxLw7", "G1aGMabQAxT5I", "3eIk0vrDK6Wy", "fNLeUd3SjD7G", "EwXszeMfcnwS", "L0G5DzIXoFf3", "z36z4U6F0XwS", "iWJ2SQ9rUtMo", "FfM9sZqNPfzz", "yAUgLMi1A5jqr", "DRfuHT6Q2LvC"]);

        $sidebar = $this->getSongs('index_sidebar_songs', ["5aki2rRJ3VHh", "j3awUEpymF4A", "K8zGqF0HBZmN", "c1TTbgotXL9T", "RrzSbtwkNO32", "AHX2SHdodJlR", "I340AgjHhO2n", "3ZQTDt8gdl4v", "Wbl0lGylnp5A", "HK91COzQOh4i", "HX66tjrmb2KX", "szEi6RQwCuAj", "Xb0txCxrKSCh", "M8JCkdWRkcUq", "OaFVYaWeZ1mi", "oU0qaWPWljVh"]);

        return [
            'main'    => $main,
            'sidebar' => [
                //'primary'   => $this->loadTop20Song->execute('us', 'bai-hat'),
                //'secondary' => $this->loadTop20Song->execute('kr', 'bai-hat'),
                'playlist' => $sidebar,
            ],
        ];
    }

    /**
     * Gets the main.
     *
     * @return     <type>  The main.
     */
    private function getSongs(string $cache_key, array $ids)
    {
        if ( ! $songs = Cache::store('redis')->get($cache_key)) {
            $songs = $this->songModel->findBySongIdsWithOrder($ids);
            $songs->load('listens');
            Cache::store('redis')->put($cache_key, $songs, now()->addMinutes(1000));
        }

        return $songs;
    }
}
