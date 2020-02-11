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

    public function execute(NCTSong $song, array $relationSongs)
    {
        if ( ! empty($relationSongs)) {
            $this->nctRelate->where('song_id', $song->song_id)->delete();
        }

        foreach ($relationSongs as $relationSong) {
            $relations[] = ['song_id' => $song->song_id, 'relate_id' => $relationSong['song_id']];
        }

        return $this->nctRelate->insert($relations);
    }
}
