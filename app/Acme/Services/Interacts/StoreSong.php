<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;

class StoreSong
{
    private $createSongs;
    private $createRelations;
    /**
     * [__construct description]
     *
     * @param      CreateSongs      $createSongs      The create songs
     * @param      CreateRelations  $createRelations  The create relations
     * @param      NCTSong  $song   [description]
     */
    public function __construct(CreateSongs $createSongs, CreateRelations $createRelations)
    {
        $this->createSongs     = $createSongs;
        $this->createRelations = $createRelations;
    }

    /**
     * { function_description }
     *
     * @param      \App\Models\NCTSong  $song      The song
     * @param      array                $songAttr  The song attribute
     * @param      array                $songs     The songs
     *
     * @throws     StoreSongException   (description)
     */
    public function execute(NCTSong $song, array $songAttr, array $songs)
    {
        $song->updated_at = now();
        if ( ! $song->fill($songAttr)->save()) {
            throw new StoreSongException('UPDATE_SONG', [$songAttr]);
        }

        if ( ! $this->createSongs->execute($songs)) {
            throw new StoreSongException('CREATE_SONG', [$songs]);
        }

        if ( ! $this->createRelations->execute($song, $songs)) {
            throw new StoreSongException('CREATE_RELATION', [$song, $songs]);
        }
    }
}
