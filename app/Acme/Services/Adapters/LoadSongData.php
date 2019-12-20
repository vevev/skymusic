<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Acme\Services\Fetchs\FetchSong;
use App\Acme\Services\Interacts\GetSong;
use App\Exceptions\SongNotFoundException;
use App\Acme\Services\Interacts\CacheSong;
use App\Acme\Services\Interacts\StoreSong;
use App\Acme\Services\Fetchs\FetchHtmlSong;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\Adapters\LoadTop20Song;
use App\Acme\Services\Extracts\ExtractSongHtml;
use App\Acme\Services\Interacts\CreateRelations;

class LoadSongData
{
    private $getSong;
    private $cacheSong;
    private $fetchSong;
    private $storeSong;
    private $loadTop20Song;

    /**
     * Constructs a new instance.
     *
     * @param      \App\Acme\Services\Fetchs\FetchHtmlSong       $fetchHtmlSong    The fetch html song
     * @param      \App\Acme\Services\Interacts\GetSong          $getSong          The get song
     * @param      \App\Acme\Services\Extracts\ExtractSongHtml   $extractSongHtml  The extract song html
     * @param      \App\Acme\Services\Interacts\CreateSongs      $createSongs      The create songs
     * @param      \App\Acme\Services\Interacts\CreateRelations  $createRelations  The create relations
     */
    public function __construct(
        GetSong $getSong,
        LoadTop20Song $loadTop20Song,
        CacheSong $cacheSong,
        FetchSong $fetchSong,
        StoreSong $storeSong
    ) {
        $this->getSong       = $getSong;
        $this->loadTop20Song = $loadTop20Song;
        $this->cacheSong     = $cacheSong;
        $this->fetchSong     = $fetchSong;
        $this->storeSong     = $storeSong;
    }

    /**
     * { function_description }
     *
     * @param      string                                 $id     The identifier
     *
     * @throws     \App\Exceptions\SongNotFoundException  (description)
     *
     * @return     <type>                                 ( description_of_the_return_value )
     */
    public function execute(string $id)
    {
        // Neu khong ton tai bai hat thi the throw loi ma khong crawl
        if ( ! $song = $this->getSong->execute($id)) {
            throw new SongNotFoundException;
        }

        // Neu bai hat chua crawl day du hoac het han thi tien hanh crawl va save
        elseif ( ! $song->hasFetched() || $song->expired()) {
            $this->fetchAndSaveSong($song);

            $song->load(['options', 'relates', 'sky']);
            $song->relates->load(['listens']);
            $this->cacheSong->set($song);
        }

        return [
            'song'    => $song,
            'sidebar' => [
                'primary' => $this->loadTop20Song->execute('vn', 'bai-hat'),
            ],
        ];
    }

    /**
     * Fetches and save song.
     *
     * @param      NCTSong  $song   The song
     */
    private function fetchAndSaveSong(NCTSong $song)
    {
        [$songAttr, $arraySong] = $this->fetchSong->execute($song);

        $song->updateOrInsertOption([
            'song_id'     => $song->song_id,
            'canDownload' => $songAttr['canDownload'],
        ]);

        unset($songAttr['canDownload']);

        $this->storeSong->execute($song, $songAttr, $arraySong);
    }
}
