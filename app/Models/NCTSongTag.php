<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NCTSongTag extends Model
{
    public $primaryKey = 'song_id';

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'nct_song_tag';

    protected $fillable = ['song_id', 'tag_id'];
}
