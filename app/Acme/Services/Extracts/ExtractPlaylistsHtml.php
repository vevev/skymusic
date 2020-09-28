<?php

namespace App\Acme\Services\Extracts;

class ExtractPlaylistsHtml
{
    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct() {}

    /**
     * { function_description }
     *
     * @param      string  $html   The html
     *
     * @return     void|array   ( description_of_the_return_value )
     */
    public function execute(string $html)
    {
        //https://www.nhaccuatui.com/ajax/get-media-info?key2=79e36a956d4f2b764a7ad25d329b6219
        // filter Src
        $patternSrc = '#(?=src="([^"]+?)")#i';
        preg_match_all($patternSrc, $html, $matchesPrimarySrc, PREG_SET_ORDER);

        // filter Data Src
        $patternSrc = '#(?=data-src="([^"]*?)")#i';
        if ( ! preg_match_all($patternSrc, $html, $matchesSrc, PREG_SET_ORDER)) {
            return;
        }

        // Lọc ra các real ID bài hát, nếu không có thì trả lại null
        $patternRealId = '#(?=NCTCounter_pl_(\d+))#';
        if ( ! preg_match_all($patternRealId, $html, $matchesRealId, PREG_SET_ORDER)) {
            return;
        }

        // Lọc ra name, nếu không có thì trả lại null
        $patternName = '#(?=<h3[^><]*><a[^><].+href=".*?/playlist/(.+)\.(.+)\.html">(.+?)</a></h3>)#i';
        if ( ! preg_match_all($patternName, $html, $matchesName, PREG_SET_ORDER)) {
            return;
        }

        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternSingle = '#<h4 class="singer_song">.+?</h4>#is';
        if ( ! preg_match_all($patternSingle, $html, $matchesSingle, PREG_SET_ORDER)) {
            return;
        }

        $patternKey = '#(?=keyEncrypt="([^"]+?)")#i';
        preg_match_all($patternKey, $html, $matchesKey, PREG_SET_ORDER);

        if (count($matchesSingle) !== count($matchesName)) {
            return;
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
                'single'      => implode(',', $single[1]),
            ];
        }

        return $playlists;
    }
}
