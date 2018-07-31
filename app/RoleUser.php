<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $fillable     = ['user_id','role_id'];

    protected $table        = 'role_user';

    public $timestamps = false;

    public function getRole()
    {
        return $this->hasOne('App\Role','id','role_id');
    }

    public function getUser(){
        return $this->hasOne('App\User','id','user_id');
    }

}
