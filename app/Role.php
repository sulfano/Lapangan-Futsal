<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $fillable = [
    'id',
    'name',
    'display_name',
    'description'
    ];
    public $timestamps = false;

    public function permissionRole(){
        return $this->hasMany(PermissionRole::class);
    }
    public function userRole(){
    	return $this->hasMany(RoleUser::class);
    }
}
