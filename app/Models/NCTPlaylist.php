<?php

namespace App\Models;

use App\Models\NCTListen;
use App\Acme\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class NCTPlaylist extends Model
{
    protected $table     = 'nct_playlists';
    public $incrementing = true;
    public $primaryKey   = 'real_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot', 'listens', 'id', 'created_at', 'updated_at', 'real_id', 'key', 'lyric'];

    protected $fillable = ['lyric', 'listen', 'thumbnail', 'key'];

    protected $appends = ['detail_url'];

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
     * { function_description }
     *
     * @param      string  $playlist_id  The playlist identifier
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function findById(string $playlist_id)
    {
        return $this->where('playlist_id', $playlist_id)->first();
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
     * Determines if it has fetched.
     *
     * @return     boolean  True if has fetched, False otherwise.
     */
    public function hasFetched()
    {
        return $this->relates->count();
    }
}