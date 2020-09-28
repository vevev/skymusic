<?php

namespace App\Acme\Services\Extracts;

use Illuminate\Support\Str;

class ExtractTop100Song
{
    /**
     * [__construct description]
     */
    public function __construct() {}

    /**
     * { function_description }
     *
     * @param      string  $html   The html
     *
     * @return     array   ( description_of_the_return_value )
     */
    public function execute(string $html)
    {
        if ( ! preg_match('#<ul class="list_show_chart">.+?</ul>#s', $html, $matches)) {
            return;
        }

        $html = $matches[0];
        // Lọc ra các row bài hát, nếu không có thì trả lại null
        $patternName = '#(?=<h3[^><]*><a[^><]*>(.+?)</a></h3>)#';
        if ( ! preg_match_all($patternName, $html, $matchesName, PREG_SET_ORDER)) {
            return;
        }

        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternId = '#(?=id="btnShowBoxPlaylist_([^"]+)")#i';
        if ( ! preg_match_all($patternId, $html, $matchesId, PREG_SET_ORDER)) {
            return;
        }

        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternSingle = '#<h4[^><]*class="list_name_singer"[^<>]*>(.+?)</h4>#is';
        if ( ! preg_match_all($patternSingle, $html, $matchesSingle, PREG_SET_ORDER)) {
            return;
        }

        $patternKey = '#(?=<span keyEncrypt="([^"]+?)")#is';
        preg_match_all($patternKey, $html, $matchesKey, PREG_SET_ORDER);
        $patternSrc = '#(?=data-src="([^"]*?)")#i';
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
            if ( ! preg_match_all('#(?=<a[^><]*>(.+?)</a>)#', $matchesSingle[$index][1], $singles)) {
                return;
            }

            $songs[] = [
                'slug'      => Str::slug($match[1] . " " . implode(' ft ', $singles[1])),
                'real_id'   => $matchesRealId[$index][1],
                'thumbnail' => $matchesSrc[$index][1],
                'song_id'   => $matchesId[$index][1],
                'name'      => $match[1],
                //'key'       => $matchesKey[$index][1],
                'single'    => trim(implode(', ', $singles[1])),
            ];
        }

        return $songs;
    }
}
