<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKYMUSIC_Song extends Model
{
    protected $table     = 'skymusic_songs';
    public $incrementing = true;
    public $primaryKey   = 'real_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot'];

    protected $fillable = ['lyric', 'listen', 'thumbnail'];

    /**
     * [findBySongIds description]
     *
     * @param  array  $keys           [description]
     * @return [type] [description]
     */
    public function findBySongKeys(array $keys)
    {
        return $this->whereIn('key', $keys)->get();
    }

    /**
     * [findBySongIds description]
     *
     * @param  array  $keys           [description]
     * @return [type] [description]
     */
    public function findByKey(string $key)
    {
        return $this->where('key', $key)->first();
    }

    public function relates()
    {
        return $this->belongsToMany(NCTSong::class, 'nct_song_song', 'key', 'relate_id', 'key', 'key');
    }
}
