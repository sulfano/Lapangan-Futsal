<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $table = 'permissions';
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
}
