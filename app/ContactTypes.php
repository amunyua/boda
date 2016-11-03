<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactTypes extends Model
{
    protected $fillable = array(
        'contact_type_name', 'contact_type_code', 'contact_type_status'
    );
}
