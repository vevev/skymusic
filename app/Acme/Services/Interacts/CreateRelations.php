<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;
use App\Models\NCTRelate;

class CreateRelations
{
    private $relate;

    public function __construct(NCTRelate $nctRelate)
    {
        $this->nctRelate = $nctRelate;
    }

    public function execute(NCTSong $song, array $songs)
    {
        $this->nctRelate->where('song_id', $song->song_id)->delete();

        foreach ($songs as $_song) {
            $relations[] = ['song_id' => $song->song_id, 'relate_id' => $_song['song_id']];
        }

        return $this->nctRelate->insert($relations);
    }
}
