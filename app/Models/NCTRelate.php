<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NCTRelate extends Model
{
    protected $table     = 'nct_relates';
    public $incrementing = true;
    public $primaryKey   = 'song_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot'];

    protected $fillable = ['song_id', 'relate_id'];
}
