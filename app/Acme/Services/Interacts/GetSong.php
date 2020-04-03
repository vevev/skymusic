<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;

class GetSong
{
    private $song;
    /**
     * [__construct description]
     *
     * @param NCTSong $song [description]
     */
    public function __construct(NCTSong $song)
    {
        $this->song = $song;
    }

    public function execute(string $id)
    {
        // if ($song = Cache::store('redis')->get('song:' . $id)) {
        //     $song->cached = true;

        //     return $song;
        // }

        return $this->song->findById($id);
    }
}
