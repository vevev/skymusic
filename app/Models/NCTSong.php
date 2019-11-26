<?php

namespace App\Models;

use App\Models\NCTSong;
use Illuminate\Database\Eloquent\Model;

class NCTSong extends Model
{
    protected $table     = 'nct_songs';
    public $incrementing = true;
    public $primaryKey   = 'real_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot'];

    protected $fillable = ['lyric', 'listen', 'thumbnail'];

    /**
     * [findBySongIds description]
     *
     * @param  array  $song_ids       [description]
     * @return [type] [description]
     */
    public function findBySongIds(array $song_ids)
    {
        return $this->whereIn('song_id', $song_ids)->get();
    }

    /**
     * [findBySongIds description]
     *
     * @param  array  $song_ids       [description]
     * @return [type] [description]
     */
    public function findById(string $song_id)
    {
        return $this->where('song_id', $song_id)->first();
    }

    public function relates()
    {
        return $this->belongsToMany(NCTSong::class, 'nct_relates', 'song_id', 'relate_id', 'song_id', 'song_id');
    }

    public function getListenAttribute()
    {
        return number_format(random_int(10000, 900000), 0, ',', ',');
    }
}
