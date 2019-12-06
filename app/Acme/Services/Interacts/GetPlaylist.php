<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTPlaylist;
use Illuminate\Support\Facades\Cache;

class GetPlaylist
{
    private $playlist;
    /**
     * [__construct description]
     *
     * @param NCTPlaylist $playlist [description]
     */
    public function __construct(NCTPlaylist $playlist)
    {
        $this->playlist = $playlist;
    }

    public function execute(string $id)
    {
        $playlist = Cache::store('file')->get($id);
        if (null != $playlist) {
            return $playlist;
        }

        if ($playlist = $this->playlist->findById($id)) {
            return $playlist;
        }
    }
}
