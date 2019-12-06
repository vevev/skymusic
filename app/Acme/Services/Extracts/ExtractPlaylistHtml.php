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
        if ( ! preg_match('#<ul id="ulListSongItem".+?</ul>#is', $html, $ul)) {
            return;
        }

        // Lọc ra các row bài hát, nếu không có thì trả lại null
        $patternName = '#(?=<h3[^<>]+id="songInPlaylist_(\d+)"[^><]+><a[^><]+?href="[^"]*\/bai-hat\/([^"\/]+?)\.([^"\/]+?).html">(.+?)<\/a><\/h3>)#';
        if ( ! preg_match_all($patternName, $ul[0], $matchesName, PREG_SET_ORDER)) {
            return;
        }

        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternSingle = '#<h4 class="singer_song">.+?</h4>#is';
        if ( ! preg_match_all($patternSingle, $ul[0], $matchesSingle, PREG_SET_ORDER)) {
            return;
        }

        $patternKey = '#(?=<span keyEncrypt="([^"]+?)")#is';
        preg_match_all($patternKey, $ul[0], $matchesKey, PREG_SET_ORDER);

        if (count($matchesSingle) !== count($matchesName)) {
            return;
        }

        $songs = [];
        foreach ($matchesName as $index => $match) {
            preg_match_all('#(?=<a[^>]+?>(.+?)</a>)#', $matchesSingle[$index][0], $single);

            $songs[] = [
                'slug'      => $match[1],
                'real_id'   => $matchesRealId[$index][1],
                'thumbnail' => 'NO_THUMBNAIL',
                'song_id'   => $match[2],
                'name'      => $match[3],
                'key'       => $matchesKey[$index][1] ?? null,
                'single'    => implode(',', $single[1]),
            ];
        }

        return [$song, $songs];
    }

    /**
     * Trích xuất lời bài hát
     *
     * @param  string $html           [description]
     * @return [type] [description]
     */
    private function extractLyric(string $html)
    {
        $pattern = '#<p class="lyric">(.*?)</p>#si';
        $lyric   = 'Chưa có lời bài hát';
        if (preg_match($pattern, $html, $matches)) {
            $lyric = strip_tags($matches[1]);
            $lyric = html_entity_decode($lyric);

            return trim($lyric);
        }
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
