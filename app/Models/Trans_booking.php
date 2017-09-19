<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_booking extends Model
{
    protected $table = 'trans_booking';
    protected $guarded = ['id','created_at','updated_at'];
}
