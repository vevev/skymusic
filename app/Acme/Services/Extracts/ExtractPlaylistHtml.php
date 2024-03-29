<?php

namespace App\Acme\Services\Extracts;

class ExtractPlaylistHtml
{
    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct() {}

    public function execute(string $html)
    {
        $playlist['key'] = $this->extractKey($html);

        return $playlist;
        // if ( ! preg_match('#<ul id="ulListSongItem".+?</ul>#is', $html, $ul)) {
        //     return;
        // }

        // // Lọc ra các row bài hát, nếu không có thì trả lại null
        // $patternName = '#(?=<h3[^<>]+id="songInPlaylist_(\d+)"[^><]+><a[^><]+?href="[^"]*\/bai-hat\/([^"\/]+?)\.([^"\/]+?).html">(.+?)<\/a><\/h3>)#';
        // if ( ! preg_match_all($patternName, $ul[0], $matchesName, PREG_SET_ORDER)) {
        //     return;
        // }

        // // Lọc ra các single bài hát, nếu không có thì trả lại null
        // $patternSingle = '#<h4 class="singer_song">(.+?)</h4>#is';
        // if ( ! preg_match_all($patternSingle, $ul[0], $matchesSingle, PREG_SET_ORDER)) {
        //     return;
        // }

        // $patternKey = '#(?=<span keyEncrypt="([^"]+?)")#is';
        // preg_match_all($patternKey, $ul[0], $matchesKey, PREG_SET_ORDER);

        // if (count($matchesSingle) !== count($matchesName)) {
        //     return;
        // }

        // $songs = [];
        // foreach ($matchesName as $index => $match) {
        //     $songs[] = [
        //         'slug'      => $match[2],
        //         'real_id'   => $match[1],
        //         'thumbnail' => 'NO_THUMBNAIL',
        //         'song_id'   => $match[3],
        //         'name'      => $match[4],
        //         'key'       => $matchesKey[$index][1] ?? null,
        //         'single'    => $matchesSingle[$index][1],
        //     ];
        // }

        // return [$playlist = null, $songs];
    }

    /**
     * Trich xuat key
     *
     * @param  string $html           [description]
     * @return [type] [description]
     */
    private function extractKey(string $html)
    {
        $patternKey = '#<span id="icon-play" key="[^"]+?" keyEncrypt="([^"]+?)"#';
        if (preg_match($patternKey, $html, $matches)) {
            return $matches[1];
        }
    }
}
