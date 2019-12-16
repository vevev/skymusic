<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTPlaylist;
use Illuminate\Support\Facades\Cache;

class CachePlaylist
{
    private $playlist;
    private $cache_key;

    /**
     * Constructs a new instance.
     *
     * @param \App\Models\NCTPlaylist $playlist The playlist
     */
    public function __construct(NCTPlaylist $playlist)
    {
        $this->playlist = $playlist;
    }

    /**
     * Gets the specified identifier.
     *
     * @param  string $id The identifier
     * @return <type> ( description_of_the_return_value )
     */
    public function get(string $id)
    {
        return Cache::store('redis')->get('playlist:' . $id);
    }

    /**
     * Gets the specified identifier.
     *
     * @param  string $id The identifier
     * @return <type> ( description_of_the_return_value )
     */
    public function forget(string $id)
    {
        return Cache::store('redis')->forget('playlist:' . $id);
    }

    /**
     * { function_description }
     *
     * @param  \App\Models\NCTPlaylist $playlist The playlist
     * @return <type>                  ( description_of_the_return_value )
     */
    public function set(NCTPlaylist $playlist)
    {
        return Cache::store('redis')
            ->put('playlist:' . $playlist->playlist_id, $playlist, now()->addDays(7));
    }
}
