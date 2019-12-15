<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NCTPLaylistSong extends Model
{
    protected $table     = 'nct_playlist_song';
    public $incrementing = true;
    public $primaryKey   = 'playist_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot'];

    protected $fillable = ['playlist_id', 'song_id'];
}
