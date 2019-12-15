<?php

namespace App\Acme\Services\Extracts;

use Illuminate\Support\Facades\Log;

class ExtractTopicsHtml
{
    private $error = null;
    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct() {}

    public function execute(string $html)
    {
        // if (preg_match('#<div class="list_album">.+?</ul>#', $html, $ul)) {
        //     exit($ul[0]);
        // }

        $patternSrc = '#(?=<span class="avatar"><img[^><]+src="([^"]+?)")#i';
        preg_match_all($patternSrc, $html, $matchesPrimarySrc, PREG_SET_ORDER);

        $patternSrc = '#(?=<span class="avatar"><img[^><]+data-src="([^"]*?)")#i';
        if ( ! preg_match_all($patternSrc, $html, $matchesSrc, PREG_SET_ORDER)) {
            return $this->logError("data src", ['html' => $html]);
        }

        // Lọc ra các real ID bài hát, nếu không có thì trả lại null
        $patternRealId = '#(?=NCTCounter_pl_(\d+))#';
        if ( ! preg_match_all($patternRealId, $html, $matchesRealId, PREG_SET_ORDER)) {
            return $this->logError("real id", ['html' => $html]);
        }

        // Lọc ra name, nếu không có thì trả lại null
        $patternName = '#(?=<a[^><]+href=".*?/playlist/(.+)\.(.+)\.html"[^><]*class="name_song"[^><]*>(.+?)</a>)#i';
        if ( ! preg_match_all($patternName, $html, $matchesName, PREG_SET_ORDER)) {
            return $this->logError("name", ['html' => $html]);
        }

        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternSingle = '#<p>(<a[^><]+href="[^"]+"[^><]+class="name_singer"[^><]+>(.+?)<\/a>(?:, )?)+<\/p>#i';
        if ( ! preg_match_all($patternSingle, $html, $matchesSingle, PREG_SET_ORDER)) {
            return $this->logError("single", ['html' => $html]);
        }

        $patternKey = '#(?=keyEncrypt="([^"]+?)")#i';
        preg_match_all($patternKey, $html, $matchesKey, PREG_SET_ORDER);

        if (count($matchesSingle) !== count($matchesName)) {
            return $this->logError(
                "single not equal name",
                ['html' => $html, $matchesSingle, $matchesName]
            );
        }

        $playlists = [];
        foreach ($matchesName as $index => $match) {
            preg_match_all('#(?=<a[^>]+?>(.+?)</a>)#', $matchesSingle[$index][0], $single);
            $thumb       = $matchesSrc[$index][1] ? $matchesSrc[$index][1] : $matchesPrimarySrc[$index][1];
            $playlists[] = [
                'slug'        => $match[1],
                'real_id'     => $matchesRealId[$index][1],
                'thumbnail'   => $thumb,
                'playlist_id' => $match[2],
                'name'        => $match[3],
                'key'         => $matchesKey[$index][1] ?? null,
                'single'      => json_encode($single[1]),
            ];
        }

        return $playlists;
    }

    /**
     * Logs an error.
     *
     * @param string $error   The error
     * @param array  $options The options
     */
    private function logError(string $error, array $options = [])
    {
        Log::channel('topics')->debug($this->error, $options);
    }
}
