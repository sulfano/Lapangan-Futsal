<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_pengunjung extends Model
{
    protected $table = 'log_pengunjung';
    protected $guarded = ['id','created_at','updated_at'];
}
