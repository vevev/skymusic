<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This class describes a nct song option.
 */
class NCTSongOption extends Model
{
    protected $table     = 'nct_song_options';
    public $incrementing = false;
    public $primaryKey   = 'song_id';
    public $timestamps   = false;
    protected $hidden    = ['pivot'];
    protected $fillable  = ['song_id', 'canDownload', 'hasRemoved', 'isDmca', 'hasCustom', 'redirectTo'];
}
