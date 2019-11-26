<?php

namespace App\Acme\Services\Interacts;

use Illuminate\Support\Str;
use App\Models\SKYMUSIC_Song;

class CreateSongsSkymusic
{
    private $song;
    /**
     * [__construct description]
     *
     * @param SKYMUSIC_Song $song [description]
     */
    public function __construct(SKYMUSIC_Song $song)
    {
        $this->song = $song;
    }

    public function execute(array $songs)
    {
        $keys = [];
        foreach ($songs as $index => $song) {
            $song->slug        = Str::slug($song->title);
            $songs[$song->key] = [
                'key'          => $song->key,
                'title'        => $song->title,
                'slug'         => $song->slug,
                'artists'      => $song->artists,
                'duration'     => $song->duration,
                'kbit'         => $song->kbit,
                'dateModifire' => $song->dateModifire,
                'streamUrl'    => $song->streamUrl,
            ];
            unset($songs[$index]);
            $keys[] = $song->key;
        }

        $savedSongs = $this->song->findBySongKeys($keys);
        if ($savedSongs->count() === count($songs)) {
            return $savedSongs;
        }

        $savedSongs->map(function ($song) use (&$songs) {
            unset($songs[$song->key]);
        });

        return $this->song->insert($songs);
    }
}
