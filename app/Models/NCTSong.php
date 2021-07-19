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
    protected $hidden    = ['pivot', 'listens', 'id', 'created_at', 'updated_at', 'real_id', 'key', 'lyric', 'options'];

    protected $fillable = ['lyric', 'listen', 'thumbnail', 'key'];

    protected $appends = ['detail_url', 'listen'];

    protected $cached = false;

    const MAXIMUM_STORAGE_DAYS = 6;

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
        return $this->withSongIds($song_ids)->get($get);
    }

    /**
     * [findBySongIds description]
     *
     * @param  array  $song_ids       [description]
     * @return [type] [description]
     */
    public function findBySongIdsWithOrder(array $song_ids, array $get = ['*'])
    {
        return $this->withSongIds($song_ids)
                    ->orderByRaw('FIELD(song_id,\'' . implode('\',\'', $song_ids) . '\' )')
                    ->get($get);
    }

    /**
     * [findBySongIds description]
     *
     * @param  array  $song_ids       [description]
     * @return [type] [description]
     */
    public function selectWithPage(int $page, int $limit)
    {
        return $this->offset(($page - 1) * $limit)
                    ->limit($limit)
                    ->get();
    }

    public function getTotalRow()
    {
        return \DB::table('INFORMATION_SCHEMA.TABLES')
            ->where('TABLE_NAME', $this->table)
            ->where('TABLE_SCHEMA', config('database.connections.mysql.database'))
            ->get(['TABLE_ROWS'])
            ->first()
            ->TABLE_ROWS;
    }

    /**
     * [findBySongIds description]
     *
     * @param  array  $song_ids       [description]
     * @return [type] [description]
     */
    public function findById(string $song_id, array $get = ['*'])
    {
        return $this->with(['listens', 'options'])
                    ->where('song_id', $song_id)
                    ->first($get);
    }

    /**
     * { function_description }
     *
     * @param      array   $columns  The columns
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function tags()
    {
        return $this->belongsToMany(
            NCTTag::class,
            'nct_song_tag',
            'song_id',
            'tag_id',
            'song_id',
            'id'
        );
    }

    /**
     * { function_description }
     *
     * @return <type> ( description_of_the_return_value )
     */
    public function relates(array $columns = [])
    {
        if (empty($columns)) {
            $columns = [
                'song_id', 'real_id', 'name', 'slug', 'single', 'thumbnail', 'key',
            ];
        }

        return $this->belongsToMany(
                        $this,
                        'nct_song_song',
                        'song_id',
                        'relate_id',
                        'song_id',
                        'song_id'
                    )
                    ->with('listens')
                    ->select(array_map(function ($column) {
                        return 'nct_songs.' . $column;
                    }, $columns));
    }

    /**
     * Gets the cached attribute.
     *
     * @return     <type>  The cached attribute.
     */
    public function getCachedAttribute()
    {
        return $this->cached ?? null;
    }

    /**
     * Sets the cached attribute.
     *
     * @param      <type>  $value  The value
     */
    public function setCachedAttribute($value)
    {
        $this->cached = $value;
    }

    /**
     * Gets the listen attribute.
     *
     * @return <type> The listen attribute.
     */
    public function getListenAttribute()
    {
        $listen = optional($this->listens)->listen ?? 0;

        return $listen > 0 ? Helper::formatView($listen) : '-';
    }

    /**
     * Gets the detail url attribute.
     *
     * @return <type> The detail url attribute.
     */
    public function getDetailUrlAttribute()
    {
        return route('song', ['slug' => $this->slug, 'id' => $this->song_id]);
    }

    /**
     * Gets the confirm url attribute.
     *
     * @return <type> The confirm url attribute.
     */
    public function getConfirmUrlAttribute()
    {
        return route('confirm', ['slug' => $this->slug, 'id' => $this->song_id]);
    }

    /**
     * Gets the download url attribute.
     *
     * @return <type> The download url attribute.
     */
    public function getDownloadUrlAttribute()
    {
        return route('download', ['slug' => $this->slug, 'id' => $this->song_id]);
    }

    /**
     * Gets the song with listen is null.
     *
     * @param  integer $limit The limit
     * @return <type>  The song with listen is null.
     */
    public function getSongWithListenIsNull(int $limit = 20, array $get = ['*'])
    {
        return $this->leftJoin('nct_listens', 'nct_listens.real_id', '=', 'nct_songs.real_id')
                    //->whereNotNull('nct_songs.lyric')
                    ->where(function ($query) {
                        $query->whereNull('nct_listens.real_id')
                              ->orWhere(function ($query) {
                                    $query->whereNotNull('nct_listens.real_id');
                                    $query->where('nct_listens.type', '!=', 'song');
                                });
                    })
                    ->limit($limit)
                    ->get($get);
    }

    /**
     * Gets the song with listen is null.
     *
     * @param  integer $limit The limit
     * @return <type>  The song with listen is null.
     */
    public function getSongWithListenNegativel(int $limit = 20, array $get = ['*'])
    {
        return $this->leftJoin('nct_listens', 'nct_listens.real_id', '=', 'nct_songs.real_id')
                    ->where('nct_listens.type', '=', 'song')
                    ->where('nct_listens.listen', '<', 0)
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
        return $this->hasOne(NCTListen::class, 'real_id', 'real_id');
    }

    /**
     * { function_description }
     *
     * @return <type> ( description_of_the_return_value )
     */
    public function sky()
    {
        return $this->hasOne(SKYMUSIC_Song::class, 'key', 'song_id');
    }

    /**
     * Gets the has skymusic attribute.
     *
     * @return     <type>  The has skymusic attribute.
     */
    public function getHasSkymusicAttribute()
    {
        return optional($this->sky)->count() ?? 0;
    }

    /**
     * { function_description }
     *
     * @return <type> ( description_of_the_return_value )
     */
    public function options()
    {
        return $this->hasOne(NCTSongOption::class, 'song_id', 'song_id');
    }

    /**
     * Determines if it has fetched.
     *
     * @return boolean True if has fetched, False otherwise.
     */
    public function hasFetched()
    {
        return $this->key && $this->relates->count();
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function expired()
    {
        return $this->updated_at->diffInHours(now()) > self::MAXIMUM_STORAGE_DAYS;
    }

    /**
     * Gets the can download attribute.
     *
     * @return     <type>  The can download attribute.
     */
    public function getCanDownloadAttribute()
    {
        return optional($this->options)->canDownload;
    }

    /**
     * Gets the has removed attribute.
     *
     * @return     <type>  The has removed attribute.
     */
    public function getHasRemovedAttribute()
    {
        return optional($this->options)->hasRemoved;
    }

    /**
     * Gets the is dmca attribute.
     *
     * @return     <type>  The is dmca attribute.
     */
    public function getIsDmcaAttribute()
    {
        return optional($this->options)->isDmca;
    }

    /**
     * Gets the has custom attribute.
     *
     * @return     <type>  The has custom attribute.
     */
    public function getHasCustomAttribute()
    {
        return optional($this->options)->hasCustom;
    }

    /**
     * Gets the redirect to attribute.
     *
     * @return     <type>  The redirect to attribute.
     */
    public function getRedirectToAttribute()
    {
        return optional($this->options)->redirectTo;
    }

    /**
     * { function_description }
     *
     * @param      array  $option  The option
     */
    public function updateOrInsertOption(array $option)
    {
        if (isset($this->relations['options'])) {
            foreach ($option as $attribute => $value) {
                $this->options->{$attribute} = $value;
            }

             $this->options->save();
        } else {
            $this->options()->insert($option);
        }
    }
}
