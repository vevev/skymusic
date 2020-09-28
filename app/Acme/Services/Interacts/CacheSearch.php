<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTSong;
use Illuminate\Support\Facades\Cache;

class CacheSearch
{
    private $song;
    /**
     * [__construct description]
     *
     * @param NCTSong $song [description]
     */
    public function __construct(NCTSong $song)
    {
        $this->song = $song;
    }

    /**
     * { function_description }
     *
     * @param      string  $query  The query
     * @param      int     $page   The page
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function get(string $query, int $page)
    {
        return Cache::store('file')->get($this->createKey($query, $page), null);
    }

    /**
     * { function_description }
     *
     * @param      string  $query   The query
     * @param      int     $page    The page
     * @param      <type>  $values  The values
     */
    public function set(string $query, int $page, $values)
    {
        Cache::store('file')->put($this->createKey($query, $page), $values, now()->addDays(10));
    }

    /**
     * Creates a key.
     *
     * @param      string  $query  The query
     * @param      int     $page   The page
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    private function createKey(string $query, int $page)
    {
        return sprintf('search:%s-%d', md5($query), $page);
    }
}
