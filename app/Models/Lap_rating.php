<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lap_rating extends Model
{
    protected $table = 'lap_rating';

    protected $fillable = [
    	'kodelapangan',
    	'rating',
    	'email',
    ];
}
