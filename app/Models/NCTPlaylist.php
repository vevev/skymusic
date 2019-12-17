<?php

namespace App\Models;

use App\Models\NCTSong;
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
    protected $hidden    = [
        'pivot',
        'listens',
        'id',
        'real_id',
        'key',
        'lyric',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'lyric',
        'listen',
        'thumbnail',
        'key',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['detail_url', 'listen'];

    public function scopeWithPlaylistIds(Builder $query, array $playlist_ids)
    {
        return $query->whereIn('playlist_id', $playlist_ids);
    }

    /**
     * [findByPlaylistIds description]
     *
     * @param  array  $playlist_ids   [description]
     * @return [type] [description]
     */
    public function findByPlaylistIds(array $playlist_ids, array $get = ['*'])
    {
        return $this->withPlaylistIds($playlist_ids)->get($get);
    }

    /**
     * { function_description }
     *
     * @param  array  $playlist_ids The song identifiers
     * @param  array  $get          The get
     * @return <type> ( description_of_the_return_value )
     */
    public function findByPlaylistIdsWithOrder(array $playlist_ids, array $get = ['*'])
    {
        return $this->withPlaylistIds($playlist_ids)
                    ->orderByRaw('FIELD(playlist_id,\'' . implode('\',\'', $playlist_ids) . '\' )')
                    ->get($get);
    }

    /**
     * { function_description }
     *
     * @param  string $playlist_id The playlist identifier
     * @return <type> ( description_of_the_return_value )
     */
    public function findById(string $playlist_id)
    {
        return $this->where('playlist_id', $playlist_id)->first();
    }

    /**
     * { function_description }
     *
     * @return <type> ( description_of_the_return_value )
     */
    public function songs()
    {
        return $this->belongsToMany(
            NCTSong::class,
            'nct_playlist_song',
            'playlist_id',
            'song_id',
            'playlist_id',
            'song_id'
        )->select(
            array_map(function ($column) {
                return 'nct_songs.' . $column;
            }, ['song_id', 'real_id', 'name', 'slug', 'single', 'thumbnail', 'key'])
        );
    }

    /**
     * Gets the listen attribute.
     *
     * @return <type> The listen attribute.
     */
    public function getListenAttribute()
    {
        if (isset($this->relations['listens'])) {
            return Helper::formatView($this->listens->listen);
        }

        return 0;
    }

    /**
     * Gets the detail url attribute.
     *
     * @return <type> The detail url attribute.
     */
    public function getDetailUrlAttribute()
    {
        return route('playlist', ['slug' => $this->slug, 'id' => $this->playlist_id]);
    }

    /**
     * Gets the single attribute.
     *
     * @return <type> The single attribute.
     */
    public function getSingleAttribute()
    {
        return implode(', ', json_decode($this->attributes['single']));
    }

    /**
     * Gets the playlist with listen is null.
     *
     * @param  integer $limit The limit
     * @param  array   $get   The get
     * @return <type>  The playlist with listen is null.
     */
    public function getPlaylistWithListenIsNull(int $limit = 20, array $get = ['*'])
    {
        return $this->leftJoin(
                        'nct_listens',
                        'nct_listens.real_id',
                        '=',
                        'nct_playlists.real_id')
                    ->whereNull('nct_listens.real_id')
                    ->orWhere(function ($query) {
                        $query->whereNotNull('nct_listens.real_id');
                        $query->where('nct_listens.type', '!=', 'playlist');
                    })
                    ->limit($limit)
                    ->get($get);
    }

    /**
     * { function_description }
     *
     * @return <type> ( description_of_the_return_value )
     */
    public function listens()
    {
        return $this->hasOne(NCTListen::class, 'real_id', 'real_id')->where('type', 'playlist');
    }

    /**
     * Determines if it has fetched.
     *
     * @return boolean True if has fetched, False otherwise.
     */
    public function hasFetched()
    {
        return $this->songs->count();
    }
}
