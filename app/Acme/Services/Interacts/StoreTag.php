<?php

namespace App\Acme\Services\Interacts;

use App\Models\NCTTag;
use App\Models\NCTSongTag;

class StoreTag
{
    /**
     * Luu tag cho song neu co
     *
     * @param  string    $song_id
     * @return boolean
     */
    public function execute(string $song_id)
    {
        if ( ! $keyword = $this->extractKeywordFromReferer()) {
            return;
        }

        [$tag, $songTag] = $this->firstOrCreateTag($song_id, $keyword);

        return self::$tagWasChanged = $tag->wasRecentlyCreated || $songTag->wasRecentlyCreated || false;
    }

    /**
     * Khi người dùng tìm kiếm và bấm vào link bài hát thì từ khóa sẽ xuất hiện trong referer.
     * Ta sẽ lọc các từ khóa này
     *
     * @return false|string
     */
    public function extractKeywordFromReferer()
    {
        if ( ! $keyword = $this->filterSearchKeywordInRequest()) {
            return;
        }

        return $this->cleanKeyword($keyword);
    }

    /**
     * First Or Create Tag
     *
     * @param  string $song_id       [description]
     * @param  string $tag        [description]
     * @return [type] [description]
     */
    private function firstOrCreateTag(string $song_id, string $tag)
    {
        // Lấy ra tag theo md5 hoặc khởi tạo tag mới
        $tagModel = NCTTag::firstOrCreate(['tag' => $tag]);

        // Lấy ra liên kết tag nếu tồn tại hoặc tạo liên kết mới
        $songTag = NCTSongTag::firstOrCreate(
            ['id' => $tagModel->id, 'song_id' => $song_id],
            ['id' => $tagModel->id, 'song_id' => $song_id]
        );

        return [$tag, $songTag];
    }

    /**
     * Lọc từ khóa người dùng tìm kiếm từ referer
     *
     * @return string|null
     */
    private function filterSearchKeywordInRequest()
    {
        $regex = '#\/tim-kiem\/([^/]+)/?#';
        if (preg_match($regex, $this->request->server('HTTP_REFERER'), $match)) {
            return $match[1];
        }
    }
}
