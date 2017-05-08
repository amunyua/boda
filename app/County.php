<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $fillable = array(
        'county_name', 'county_code', 'county_status'
    );
}
