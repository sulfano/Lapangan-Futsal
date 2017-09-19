<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $table = 'lapangan';

    protected $fillable = [
    	'idpeople',
    	'kodelapangan',
    	'nama',
    	'alamat',
    	'kelurahan',
    	'foto1',
    	'foto2',
    	'foto3',
    	'foto4',
    	'hargasiang',
    	'hargamalam',
    	'hargasewa',
    	'lantai',
    	'namapemilik',
    	'namapetugas',
    	'latitude',
    	'longitude',
    	'panjang',
    	'lebar',
        'perkiraan_masa',
    	'status',
    ];
}
