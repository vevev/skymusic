<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTPlaylist;
use App\Models\NCTPlaylistSong;

class CreatePlaylistSongRelations
{
    private $nctPlaylistSong;

    /**
     * Constructs a new instance.
     *
     * @param      \App\Models\NCTPlaylistSong  $nctPlaylistSong  The nct playlist song
     */
    public function __construct(NCTPlaylistSong $nctPlaylistSong)
    {
        $this->nctPlaylistSong = $nctPlaylistSong;
    }

    /**
     * { function_description }
     *
     * @param      NCTPlaylist  $playlist  The playlist
     * @param      array        $songs     The songs
     *
     * @return     <type>       ( description_of_the_return_value )
     */
    public function execute(NCTPlaylist $playlist, array $songs)
    {
        if ( ! count($songs)) {
            return true;
        }

        foreach ($songs as $song) {
            $relations[] = [
                'playlist_id' => $playlist->playlist_id,
                'song_id'     => $song['song_id'],
            ];
        }

        $this->nctPlaylistSong
             ->where('playlist_id', $playlist->playlist_id)
             ->delete();

        return $this->nctPlaylistSong->insert($relations);
    }
}
