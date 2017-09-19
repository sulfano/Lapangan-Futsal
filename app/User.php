<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    //protected $table = 'user';
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'alamat',
        'jk',
        'tanggallahir',
        'nomorhp', 
        'email', 
        'password',
        'remember_token',
        'level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // public function isAdmin()
    // {
    //     foreach ($this->roles()->get() as $role)
    //     {
    //         if($role->name == 'administrator') {
    //             return true;
    //         }
    //     }
    //     return false;
    // }


    public function roles()
    {
        return $this->belongsToMany('App\Role');

    }

    public function roleuser()
    {
        return $this->hasMany('App\RoleUser','user_id','id');
    }
}
