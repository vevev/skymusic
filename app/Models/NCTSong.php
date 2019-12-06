<?php

namespace App\Models;

use App\Models\NCTListen;
use App\Acme\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class NCTSong extends Model
{
    protected $table     = 'nct_songs';
    public $incrementing = true;
    public $primaryKey   = 'real_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot', 'listens', 'id', 'created_at', 'updated_at', 'real_id', 'key', 'lyric'];

    protected $fillable = ['lyric', 'listen', 'thumbnail', 'key'];

    protected $appends = ['detail_url', 'listen'];

    public function scopeWithSongIds(Builder $query, array $song_ids)
    {
        return $query->whereIn('song_id', $song_ids);
    }

    /**
     * [findBySongIds description]
     *
     * @param  array  $song_ids       [description]
     * @return [type] [description]
     */
    public function findBySongIds(array $song_ids, array $get = ['*'])
    {
        return $this->withSongIds($song_ids)->get();
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
        return $this->belongsToMany($this, 'nct_song_song', 'song_id', 'relate_id', 'song_id', 'song_id');
    }

    /**
     * Gets the listen attribute.
     *
     * @return     <type>  The listen attribute.
     */
    public function getListenAttribute()
    {
        if (isset($this->relations['listens'])) {
            return Helper::formatView($this->listens->listen) . ' lượt nghe';
        }

        return 0;
    }

    /**
     * Gets the detail url attribute.
     *
     * @return     <type>  The detail url attribute.
     */
    public function getDetailUrlAttribute()
    {
        return route('song', ['slug' => $this->slug, 'id' => $this->song_id]);
    }

    public function getConfirmUrlAttribute()
    {
        return route('confirm', ['slug' => $this->slug, 'id' => $this->song_id]);
    }

    public function getDownloadUrlAttribute()
    {
        return route('download', ['slug' => $this->slug, 'id' => $this->song_id]);
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

    public function hasFetched()
    {
        return $this->key && $this->relates->count();
    }
}
