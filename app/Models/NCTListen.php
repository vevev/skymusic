<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NCTListen extends Model
{
    protected $table     = 'nct_listens';
    public $incrementing = true;
    public $primaryKey   = 'real_id';
    public $timestamps   = true;
    protected $hidden    = ['pivot'];

    protected $fillable = ['real_id', 'listen', 'type'];

}
