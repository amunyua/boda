<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    //
    protected $fillable = [
        'company_name', 'company_logo'
    ];
}
