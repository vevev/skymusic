<?php

namespace App\Acme\Services\Extracts;

class ExtractSearchHtml
{
    /**
     * [__construct description]
     */
    public function __construct() {}

    public function execute(string $html)
    {
        $patternLi = '#<li.*?>.+?</li>#s';
        if ( ! preg_match_all($patternLi, $html, $matchesLi)) {
            return;
        }

        $songs = [];
        foreach ($matchesLi[0] as $index => $li) {
            // Lọc ra các row bài hát, nếu không có thì trả lại null
            $patternName = '#(?=<h3.*href=".*/bai-hat/([^/]+?)\.([^/]+?).html">(.+?)</a></h3>)#';
            if ( ! preg_match($patternName, $li, $matchesName)) {
                return;
            }

            // Lọc ra các single bài hát, nếu không có thì trả lại null
            $patternSingle = '#<h4 class="singer_song">.+?</h4>#is';
            if ( ! preg_match($patternSingle, $li, $matchesSingle)) {
                return;
            }

            $patternKey = '#(?=<span keyEncrypt="([^"]+?)")#is';
            if ( ! preg_match($patternKey, $li, $matchesKey)) {
                continue;
            }

            $patternSrc = '#(?=src="([^"]+?)")#i';
            preg_match($patternSrc, $li, $matchesPrimarySrc);

            $patternSrc = '#(?=data-src="([^"]*?)")#i';
            if ( ! preg_match($patternSrc, $li, $matchesSrc)) {
                return;
            }

            $patternRealId = '#(?=song_img_(\d+))#i';
            if ( ! preg_match($patternRealId, $li, $matchesRealId)) {
                return;
            }

            preg_match_all('#(?=<a[^>]+?>(.+?)</a>)#', $matchesSingle[0], $single);
            $thumb   = $matchesSrc[1] ? $matchesSrc[1] : $matchesPrimarySrc[1];
            $songs[] = [
                'slug'      => $matchesName[1],
                'real_id'   => $matchesRealId[1],
                'thumbnail' => $thumb,
                'song_id'   => $matchesName[2],
                'name'      => $matchesName[3],
                'key'       => $matchesKey[1],
                'single'    => implode(',', $single[1]),
            ];
        }

        return $songs;
    }
}
