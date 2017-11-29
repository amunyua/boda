<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterfile extends Model
{
    protected $guarded = ['id'];

    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function addressType(){
        return $this->belongsTo('App\AddressType');
    }
}
