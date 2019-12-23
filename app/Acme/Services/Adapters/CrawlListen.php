<?php

namespace App\Acme\Services\Adapters;

use stdClass;
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

    /**
     * { function_description }
     */
    public function execute()
    {
        $songIds     = $this->getSongIds();
        $playlistIds = $this->getPlaylistIds();

        $response = $this->fetchJsonListen->execute($songIds, $playlistIds);

        if (isset($response->songs)) {
            $this->saveListen($response->songs, 'song');
        }

        if (isset($response->playlists)) {
            $this->saveListen($response->playlists, 'playlist');
        }
        echo "string";
    }

    /**
     * Saves a listen.
     *
     * @param array  $listens The listens
     * @param string $type    The type
     */
    private function saveListen(stdClass $listens, string $type)
    {
        $insert = [];
        foreach ($listens as $index => $listen) {
            $insert[] = ['real_id' => $index, 'listen' => $listen, 'type' => $type];
        }

        $this->listenModel->insert($insert);
    }

    /**
     * Gets the song identifiers.
     *
     * @return <type> The song identifiers.
     */
    private function getSongIds()
    {
        return $this->songModel
                    ->getSongWithListenIsNull(50, ['nct_songs.real_id'])
                    ->pluck('real_id')
                    ->toArray();
    }

    /**
     * Gets the playlist identifiers.
     *
     * @return <type> The playlist identifiers.
     */
    private function getPlaylistIds()
    {
        return $this->playlistModel
                    ->getPlaylistWithListenIsNull(50, ['nct_playlists.real_id'])
                    ->pluck('real_id')
                    ->toArray();
    }
}
