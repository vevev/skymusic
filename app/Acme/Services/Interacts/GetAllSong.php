<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;
use Illuminate\Support\Facades\Cache;

class GetAllSong
{
    private $song;
    /**
     * [__construct description]
     *
     * @param      NCTSong  $song   [description]
     */
    public function __construct(NCTSong $song)
    {
        $this->song = $song;
    }

    /**
     * { function_description }
     *
     * @param      integer  $page   The page
     * @param      integer  $limit  The limit
     *
     * @return     array    ( description_of_the_return_value )
     */
    public function execute(int $page, int $limit = 20)
    {
        return [
            'rows'  => $this->getRows(),
            'songs' => $this->getSongs($page, $limit),
        ];
    }

    /**
     * Gets the rows.
     *
     * @return     integer  The rows.
     */
    private function getRows()
    {
        $cacheRowsKey = 'rows_song';
        if ( ! $rows = Cache::store('redis')->get($cacheRowsKey)) {
            $rows = $this->song->getTotalRow();
            Cache::store('redis')->put($cacheRowsKey, $rows, now()->addDays(1));
        }

        return $rows + 0;
    }

    /**
     * Gets the songs.
     *
     * @param      integer|string  $page   The page
     * @param      integer         $limit  The limit
     *
     * @return     <type>          The songs.
     */
    private function getSongs(int $page, int $limit)
    {
        $cacheKey = 'all_song:' . $page . '-' . $limit;
        if ( ! $songs = Cache::store('redis')->get($cacheKey)) {
            $songs = $this->song->selectWithPage($page, $limit);
            if ($songs->count()) {
                Cache::store('redis')->put($cacheKey, $songs, now()->addDays(1));
            }
        }

        return $songs;
    }
}
