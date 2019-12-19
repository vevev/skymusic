<?php

namespace App\Acme\Services\Interacts;

use App\Models\SKYMUSIC_Song;
use Illuminate\Support\Facades\Cache;

class CacheSkymusicSong
{
    private $song;
    private $cache_key;

    /**
     * Constructs a new instance.
     *
     * @param      \App\Models\SKYMUSIC_Song  $song   The song
     */
    public function __construct(SKYMUSIC_Song $song)
    {
        $this->song = $song;
    }

    /**
     * Gets the specified identifier.
     *
     * @param      string  $id     The identifier
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function get(string $id)
    {
        return Cache::store('redis')->get('skysong:' . $id);
    }

    /**
     * { function_description }
     *
     * @param      \App\Models\SKYMUSIC_Song  $song   The song
     *
     * @return     <type>               ( description_of_the_return_value )
     */
    public function set(SKYMUSIC_Song $song)
    {
        return Cache::store('redis')->put('skysong:' . $song->song_id, $song, now()->addDays(7));
    }
}
