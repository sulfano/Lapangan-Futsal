<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data_Kecamatan extends Model
{
    protected $table = 'data_kecamatan';

    protected $fillable = [
    	'nama',
    	'latitude',
    	'longitude',
    ];
}
