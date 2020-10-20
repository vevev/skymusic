<?php

namespace App\Acme\Services\Extracts;

use Exception;
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

        if (preg_match('#<p class="txt_404">404</p>#', $html)) {
            abort(404);
        }

        if ( ! preg_match('#<span id="icon-play" key="([^"]+)"#', $html, $id)) {
            throw new Exception("Hello");
        }

        $id = $id[1];

        $patternCanDownload = '#<\!-- start license -->#i';
        if (preg_match($patternCanDownload, $html, $matchesCanDownload)) {
            $song['canDownload'] = 0;
        }

        if ( ! preg_match('#<ul id="ulSongRecommend">.+?</ul>#is', $html, $ul)) {
            file_put_contents('/home/skymusic-errors/' . $id, "URL NOT FOUND\n\n\n\n\n\n\n" . $html);
            throw new ExtractSongException('ul not found');
        }

        // Lọc ra các row bài hát, nếu không có thì trả lại null
        $patternName = '#(?=<h3.*href=".*/bai-hat/([^/]+?)\.([^/]+?).html">(.+?)</a></h3>)#';
        if ( ! preg_match_all($patternName, $ul[0], $matchesName, PREG_SET_ORDER)) {
            file_put_contents('/home/skymusic-errors/' . $id, "name not found\n\n\n\n\n\n\n" . $ul[0]);
            throw new ExtractSongException('name not found');
        }

        // Lọc ra các single bài hát, nếu không có thì trả lại null
        $patternSingle = '#<h4 class="singer_song">.+?</h4>#is';
        if ( ! preg_match_all($patternSingle, $ul[0], $matchesSingle, PREG_SET_ORDER)) {
            file_put_contents('/home/skymusic-errors/' . $id, "SINGLE NOT FOUND\n\n\n\n\n\n\n" . $ul[0]);
            throw new ExtractSongException('SINGLE NOT FOUND');
        }

        $patternKey = '#(?=<span keyEncrypt="([^"]+?)")#is';
        preg_match_all($patternKey, $ul[0], $matchesKey, PREG_SET_ORDER);

        $patternSrc = '#(?=data-src="([^"]+?)")#i';
        if ( ! preg_match_all($patternSrc, $ul[0], $matchesSrc, PREG_SET_ORDER)) {
            file_put_contents('/home/skymusic-errors/' . $id, "SRC NOT FOUND\n\n\n\n\n\n\n" . $ul[0]);
            throw new ExtractSongException('SRC NOT FOUND');
        }

        $patternRealId = '#(?=song_img_(\d+))#i';
        if ( ! preg_match_all($patternRealId, $ul[0], $matchesRealId, PREG_SET_ORDER)) {
            file_put_contents('/home/skymusic-errors/' . $id, "REALID not found\n\n\n\n\n\n\n" . $ul[0]);
            throw new ExtractSongException('REALID not found');
        }

        if (count($matchesSingle) !== count($matchesName)) {
            file_put_contents('/home/skymusic-errors/' . $id, "song array not equal\n\n\n\n\n\n\n" . json_encode([$matchesSingle, $matchesName]));
            throw new ExtractSongException('song array not equal');
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
