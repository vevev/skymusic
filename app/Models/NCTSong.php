<?php

namespace App\Models;

use App\Models\NCTListen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class NCTSong extends Model
{
    protected $table     = 'nct_songs';
    public $incrementing = true;
    public $primaryKey   = 'real_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot'];

    protected $fillable = ['lyric', 'listen', 'thumbnail', 'key', 'listen'];

    public function scopeWithSongIds(Builder $query, array $song_ids)
    {
        return $query->whereIn('song_id', $song_ids);
    }

    public function getSongWithRelationBySongIds(array $song_ids)
    {
        return $this->with('listens')->withSongIds($song_ids)->get();
    }

    /**
     * [findBySongIds description]
     *
     * @param  array  $song_ids       [description]
     * @return [type] [description]
     */
    public function findBySongIds(array $song_ids)
    {
        return $this->with('listens')->withSongIds($song_ids)->get();
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

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function relates()
    {
        return $this->belongsToMany($this, 'nct_relates', 'song_id', 'relate_id', 'song_id', 'song_id');
    }

    /**
     * Gets the listen attribute.
     *
     * @return     <type>  The listen attribute.
     */
    public function getListenAttribute()
    {
        return number_format($this->listens->listen ?? 0, 0, ',', ',');
    }

    /**
     * Gets the song with listen is null.
     *
     * @param      integer  $limit  The limit
     *
     * @return     <type>   The song with listen is null.
     */
    public function getSongWithListenIsNull(int $limit = 20, array $get = ['*'])
    {
        return $this->leftJoin('nct_listens', 'nct_listens.real_id', '=', 'nct_songs.real_id')
                    ->whereNull('nct_listens.real_id')
                    ->limit($limit)
                    ->get($get);
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function listens()
    {
        return $this->hasOne(NCTListen::class, 'real_id', 'real_id');
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function sky()
    {
        return $this->hasOne(SKYMUSIC_Song::class, 'key', 'song_id');
    }
}
