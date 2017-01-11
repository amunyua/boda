<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    //
    protected $fillable = array(
        'company_name', 'company_logo', 'tel_one', 'tel_two', 'tel_three', 'email', 'physical_address'
    );
}
