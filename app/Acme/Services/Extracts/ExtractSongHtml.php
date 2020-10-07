<?php

namespace App\Acme\Services\Extracts;

use App\Exceptions\ExtractSongException;

class ExtractSongHtml
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
        $song['lyric'] = $this->extractLyric($html);
        $song['key']   = $this->extractKey($html);

        $song['canDownload'] = 1;

        $patternCanDownload = '#<\!-- start license -->#i';
        if (preg_match($patternCanDownload, $html, $matchesCanDownload)) {
            $song['canDownload'] = 0;
        }

        if ( ! preg_match('#<ul id="ulSongRecommend">.+?</ul>#is', $html, $ul)) {
            throw new ExtractSongException(json_encode(['ul not found', ['document' => $html]]));
        }

        // Lọc ra các row bài hát, nếu không có thì trả lại null
        $patternName = '#(?=<h3.*href=".*/bai-hat/([^/]+?)\.([^/]+?).html">(.+?)</a></h3>)#';
        if ( ! preg_match_all($patternName, $ul[0], $matchesName, PREG_SET_ORDER)) {
            throw new ExtractSongException(json_encode(['name not found', ['document' => $ul[0]]]));
        }

        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternSingle = '#<h4 class="singer_song">.+?</h4>#is';
        if ( ! preg_match_all($patternSingle, $ul[0], $matchesSingle, PREG_SET_ORDER)) {
            throw new ExtractSongException(json_encode(['single not found', ['document' => $ul[0]]]));
        }

        $patternKey = '#(?=<span keyEncrypt="([^"]+?)")#is';
        preg_match_all($patternKey, $ul[0], $matchesKey, PREG_SET_ORDER);

        $patternSrc = '#(?=data-src="([^"]+?)")#i';
        if ( ! preg_match_all($patternSrc, $ul[0], $matchesSrc, PREG_SET_ORDER)) {
            throw new ExtractSongException(json_encode(['src not found', ['document' => $ul[0]]]));
        }

        $patternRealId = '#(?=song_img_(\d+))#i';
        if ( ! preg_match_all($patternRealId, $ul[0], $matchesRealId, PREG_SET_ORDER)) {
            throw new ExtractSongException(json_encode(['realid not found', ['document' => $ul[0]]]));
        }

        if (count($matchesSingle) !== count($matchesName)) {
            throw new ExtractSongException(json_encode(['song array not equal', [$matchesSingle, $matchesName]]));
        }

        $songs = [];
        foreach ($matchesName as $index => $match) {
            preg_match_all('#(?=<a[^>]+?>(.+?)</a>)#', $matchesSingle[$index][0], $single);

            $songs[] = [
                'slug'      => mb_substr($match[1], 0, 250),
                'real_id'   => $matchesRealId[$index][1],
                'thumbnail' => $matchesSrc[$index][1],
                'song_id'   => $match[2],
                'name'      => $match[3],
                'key'       => $matchesKey[$index][1] ?? null,
                'single'    => implode(', ', $single[1]),
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
