<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    protected $table = 'acara';

        protected $fillable = [
    	'idpeople',
    	'namaacara',
        'pelaksana',
        'awal_daftar',
    	'akhir_daftar',
    	'tanggalmulai',
    	'tanggalakhir',
    	'jammulai',
    	'jamakhir',
    	'namakontak1',
    	'kontak1',
    	'namakontak2',
    	'kontak2',
    	'biaya',
    	'satuan',
    	'totalhadiah',
    	'hadiahutama',
    	'kuota',
    	'tempat',
    	'alamat',
    	'brosur',
    	'detail',
    	'status',
    ];
}
