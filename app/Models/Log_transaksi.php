<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_transaksi extends Model
{
    protected $table = 'log_transaksi';
    protected $guarded = ['id','created_at','updated_at'];
}
