<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NCTTag extends Model
{
    public $primaryKey = 'id';

    public $timestamps = false;

    protected $table = 'nct_tagw';

    protected $fillable = ['tag', 'id'];

    public function getByVideoId(string $video_id)
    {
        return $this->join('tagid', 'tagid.id', '=', 'tag.id')
                    ->where('tagid.video_id', $video_id)
                    ->limit(9)
                    ->get();
    }

    public function getManySongByTagIds(array $tagIds)
    {
        return $this->leftJoin('tagid', 'tagid.id', '=', 'tag.id')
                    ->leftJoin('songs', 'songs.video_id', '=', 'tagid.video_id')
                    ->whereIn('tagid.id', $tagIds)
                    ->groupBy('songs.video_id')
                    ->orderByDesc('songs.listen')
                    ->get(['songs.video_id', 'songs.name', 'songs.duration', 'songs.listen', 'songs.slug']);
    }

    public function relevants()
    {
        return $this->belongsToMany(RelevantTagName::class, 'relevant_tags', 'tag_id', 'relevant_id');
    }
}
