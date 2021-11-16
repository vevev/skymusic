<?php

namespace App\Acme\Services\Extracts;

class ExtractTop20Song
{
    /**
     * [__construct description]
     */
    public function __construct() {}

    public function execute(string $html)
    {
        // Lọc ra các row bài hát, nếu không có thì trả lại null
        $patternName = '#(?=<h3.*href=".*/bai-hat/([^/]+?)\.([^/]+?).html"[^>]*?>(.+?)</a></h3>)#';
        if ( ! preg_match_all($patternName, $html, $matchesName, PREG_SET_ORDER)) {
            return;
        }
        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternSingle = '#<h4 class="list_name_singer"[^>]*?>(.+?)</h4>#is';
        if ( ! preg_match_all($patternSingle, $html, $matchesSingle, PREG_SET_ORDER)) {
            return;
        }

        $patternKey = '#(?=<span keyEncrypt="([^"]+?)")#is';
        preg_match_all($patternKey, $html, $matchesKey, PREG_SET_ORDER);
        $patternSrc = '#(?=<div class="box_info_field".*?src="([^"]+?)")#is';
        if ( ! preg_match_all($patternSrc, $html, $matchesSrc, PREG_SET_ORDER)) {
            return;
        }

        $patternRealId = '#(?=NCTCounter__(\d+))#i';
        if ( ! preg_match_all($patternRealId, $html, $matchesRealId, PREG_SET_ORDER)) {
            return;
        }

        if (count($matchesSingle) !== count($matchesName)) {
            return;
        }

        $songs = [];
        foreach ($matchesName as $index => $match) {
            $songs[] = [
                'slug'      => $match[1],
                'real_id'   => $matchesRealId[$index][1],
                'thumbnail' => $matchesSrc[$index][1],
                'song_id'   => $match[2],
                'name'      => $match[3],
                //'key'       => $matchesKey[$index][1],
                'single'    => trim(strip_tags($matchesSingle[$index][1])),
            ];
        }

        return $songs;
    }
}
