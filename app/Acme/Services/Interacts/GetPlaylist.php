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
        if ($playlist = Cache::store('redis')->get('playlist:' . $id)) {
            $playlist->cached = true;

            return $playlist;
        }

        return $this->playlist->findById($id);
    }
}
