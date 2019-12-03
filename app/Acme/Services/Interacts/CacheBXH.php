<?php

namespace App\Acme\Services\Interacts;

use Illuminate\Support\Facades\Cache;

class CacheBXH
{
    private $cache_key_format = 'bxh-%s-%s';

    public function __construct() {}

    public function set(string $country, string $type, array $songs)
    {
        $cache_key = sprintf('bxh-%s-%s', $country, $type);
        Cache::forever($cache_key, $songs);
    }

    public function get(string $country, string $type)
    {
        $cache_key = sprintf('bxh-%s-%s', $country, $type);

        return Cache::get($cache_key);
    }
}
