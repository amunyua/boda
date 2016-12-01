<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = array(
        'county', 'city', 'masterfile_id', 'postal_code', 'email', 'phone_no', 'tel_no', 'postal_address',
        'postal_code', 'physical_address'
    );

    public function masterfile(){
        return $this->belongsTo('App\Masterfile');
    }
}
