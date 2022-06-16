<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;
use Illuminate\Support\Facades\Cache;

class CacheSong
{
    private $song;
    private $cache_key;

    /**
     * Constructs a new instance.
     *
     * @param \App\Models\NCTSong $song The song
     */
    public function __construct(NCTSong $song)
    {
        $this->song = $song;
    }

    /**
     * Gets the specified identifier.
     *
     * @param  string $id The identifier
     * @return <type> ( description_of_the_return_value )
     */
    public function get(string $id)
    {
        // return Cache::get('song:' . $id);
        return Cache::store(config('app.cache_song'))->get('song:' . $id);
    }

    /**
     * { function_description }
     *
     * @param  \App\Models\NCTSong $song The song
     * @return <type>              ( description_of_the_return_value )
     */
    public function set(NCTSong $song)
    {
        // return Cache::put('song:' . $song->song_id, $song, now()->addDays(7));
        return Cache::store(config('app.cache_song'))->put('song:' . $song->song_id, $song, now()->addDays(NCTSong::MAXIMUM_STORAGE_DAYS));
    }
}
