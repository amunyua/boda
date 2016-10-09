<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = array(
        'subject_name', 'subject_code', 'subject_status', 'mandatory'
    );
}
