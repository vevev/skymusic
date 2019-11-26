<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;
use Illuminate\Support\Facades\Cache;

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
        $song = Cache::store('file')->get($id);
        if (null != $song) {
            return $song;
        }

        if ($song = $this->song->findById($id)) {
            return $song;
        }
    }
}
