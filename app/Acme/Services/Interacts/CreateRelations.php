<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;
use App\Models\NCTRelate;

class CreateRelations
{
    private $relate;

    /**
     * Constructs a new instance.
     *
     * @param      \App\Models\NCTRelate  $relate  The relate
     */
    public function __construct(NCTRelate $relate)
    {
        $this->relate = $relate;
    }

    /**
     * { function_description }
     *
     * @param      \App\Models\NCTSong  $song   The song
     * @param      array                $songs  The songs
     *
     * @return     <type>               ( description_of_the_return_value )
     */
    public function execute(NCTSong $song, array $songs)
    {
        if ( ! isset($song->changes['key'])) {
            $this->relate
                 ->where('song_id', $song->song_id)
                 ->delete();
        }

        foreach ($songs as $_song) {
            $relations[] = [
                'song_id'   => $song->song_id,
                'relate_id' => $_song['song_id'],
            ];
        }

        return $this->relate->insert($relations);
    }
}
