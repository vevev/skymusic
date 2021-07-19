<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NCTRelate extends Model
{
    protected $table     = 'nct_song_song';
    public $incrementing = false;
    public $primaryKey   = 'song_id';
    protected $keyType = 'string';
    public $timestamps   = true;
    protected $hidden    = ['pivot'];

    protected $fillable = ['song_id', 'relate_id'];
}
