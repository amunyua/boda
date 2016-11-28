<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterfile extends Model
{
    protected $fillable = array(
        'surname', 'firstname', 'middlename', 'gender', 'id_no', 'user_role', 'b_role', 'registration_date',
        'image_path', 'status'
    );

    public function user(){
        return $this->hasOne('App\User');
    }

    public function addresses(){
        return $this->hasMany('App\Address');
    }
}
