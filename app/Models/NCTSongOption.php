<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This class describes a nct song option.
 */
class NCTSongOption extends Model
{
    protected $table     = 'nct_song_options';
    public $incrementing = true;
    public $primaryKey   = null;
    public $timestamps   = true;
    protected $hidden    = ['pivot'];
    protected $fillable  = ['song_id', 'canDownload', 'hasRemoved', 'isDmca', 'hasCustom', 'redirectTo'];
}
