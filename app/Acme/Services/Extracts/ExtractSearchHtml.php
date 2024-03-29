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
        // Lọc ra các row bài hát, nếu không có thì trả lại null
        $patternName = '#(?=<h3.*href=".*/bai-hat/([^/]+?)\.([^/]+?).html">(.+?)</a></h3>)#';
        if ( ! preg_match_all($patternName, $html, $matchesName, PREG_SET_ORDER)) {
            return;
        }

        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternSingle = '#<h4 class="singer_song">.+?</h4>#is';
        if ( ! preg_match_all($patternSingle, $html, $matchesSingle, PREG_SET_ORDER)) {
            return;
        }

        $patternKey = '#(?=<span keyEncrypt="([^"]+?)")#is';
        if ( ! preg_match_all($patternKey, $html, $matchesKey, PREG_SET_ORDER)) {
            return;
        }

        $patternSrc = '#(?=src="([^"]+?)")#i';
        preg_match_all($patternSrc, $html, $matchesPrimarySrc, PREG_SET_ORDER);

        $patternSrc = '#(?=data-src="([^"]*?)")#i';
        if ( ! preg_match_all($patternSrc, $html, $matchesSrc, PREG_SET_ORDER)) {
            return;
        }

        $patternRealId = '#(?=song_img_(\d+))#i';
        if ( ! preg_match_all($patternRealId, $html, $matchesRealId, PREG_SET_ORDER)) {
            return;
        }

        if (count($matchesSingle) !== count($matchesName)
            || count($matchesSingle) !== count($matchesKey)) {
            return;
        }

        $songs = [];
        foreach ($matchesName as $index => $match) {
            preg_match_all('#(?=<a[^>]+?>(.+?)</a>)#', $matchesSingle[$index][0], $single);
            $thumb   = $matchesSrc[$index][1] ? $matchesSrc[$index][1] : $matchesPrimarySrc[$index][1];
            $songs[] = [
                'slug'      => mb_substr($match[1], 0, 250),
                'real_id'   => $matchesRealId[$index][1],
                'thumbnail' => $thumb,
                'song_id'   => $match[2],
                'name'      => $match[3],
                'key'       => $matchesKey[$index][1],
                'single'    => implode(', ', $single[1]),
            ];
        }

        return $songs;
    }
}
