<?php

namespace App\Models;

use App\Models\NCTSong;
use App\Models\NCTListen;
use App\Acme\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class SKYMUSIC_Song extends Model
{
    protected $table     = 'skymusic_songs';
    public $incrementing = true;
    public $primaryKey   = 'real_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot', 'listens', 'id', 'created_at', 'updated_at', 'real_id', 'key', 'lyric'];
    protected $fillable  = ['lyric', 'listen', 'thumbnail', 'key'];
    protected $appends   = ['detail_url', 'listen', 'cached'];

    /**
     * Gets the cached attribute.
     *
     * @return     <type>  The cached attribute.
     */
    public function getCachedAttribute()
    {
        return $this->appends['cached'] ?? null;
    }

    /**
     * Sets the cached attribute.
     *
     * @param      <type>  $value  The value
     */
    public function setCachedAttribute($value)
    {
        $this->appends['cached'] = $value;
    }

    /**
     * Gets the listen attribute.
     *
     * @return <type> The listen attribute.
     */
    public function getListenAttribute()
    {
        return Helper::formatView(optional($this->listens)[0]->listen ?? 0);
    }

    /**
     * Gets the lyric attribute.
     *
     * @return     <type>  The lyric attribute.
     */
    public function getLyricAttribute()
    {
        return optional($this->relations['song'])->lyric;
    }

    /**
     * Gets the listen attribute.
     *
     * @return <type> The listen attribute.
     */
    public function getThumbnailAttribute()
    {
        return optional($this->relations['song'])->thumbnail ?? '/images/audio_default.png';
    }

    /**
     * Gets the detail url attribute.
     *
     * @return <type> The detail url attribute.
     */
    public function getDetailUrlAttribute()
    {
        return route('song-skymusic', ['slug' => $this->slug, 'id' => $this->song_id]);
    }

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

    /**
     * { function_description }
     *
     * @return <type> ( description_of_the_return_value )
     */
    public function listens()
    {
        // return $this->hasManyThrough(
        //     'App\Post',
        //     'App\User',
        //     'country_id', // Foreign key on users table...
        //     'user_id', // Foreign key on posts table...
        //     'id', // Local key on countries table...
        //     'id' // Local key on users table...
        // );
        return $this->hasManyThrough(
            NCTListen::class,
            NCTSong::class,
            'song_id', // Foreign key on Song table...
            'real_id', // Foreign key on Listen table...
            'key',     // Local key on countries table...
            'real_id'  // Local key on users table...
        );
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function relates()
    {
        return $this->belongsToMany(NCTSong::class, 'nct_song_song', 'song_id', 'relate_id', 'key', 'song_id');
    }

    /**
     * { function_description }
     *
     * @return <type> ( description_of_the_return_value )
     */
    public function song()
    {
        return $this->hasOne(NCTSong::class, 'song_id', 'key');
    }
}
