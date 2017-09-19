<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PermissionRole extends Model
{
    protected $table = 'permission_role';
    protected $fillable = [
    'permission_id',
    'user_id',
    ];
    public $timestamps = false;
    public function permission(){
        return $this->belongsTo(Permission::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
