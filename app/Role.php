<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = array(
        'role_name', 'role_code', 'role_status'
    );

    public function routes(){
        return $this->belongsToMany("App\Route");
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
