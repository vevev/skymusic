<?php

namespace App\Acme\Services\Interacts;

use Illuminate\Support\Facades\Cache;

class CacheTop100
{
    private $cache_key_format = 'top-100-%s-%s';

    public function __construct() {}

    public function set(string $category, string $category_id, array $songs)
    {
        $cache_key = sprintf('top-100-%s-%s', $category, $category_id);
        Cache::forever($cache_key, $songs);
    }

    public function get(string $category, string $category_id)
    {
        $cache_key = sprintf('top-100-%s-%s', $category, $category_id);

        return Cache::get($cache_key);
    }
}
