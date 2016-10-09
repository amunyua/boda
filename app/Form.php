<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = array(
        'form_name', 'form_code', 'form_status'
    );
}


