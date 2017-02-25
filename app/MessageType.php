<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageType extends Model
{
    protected $fillable = array(
        'message_type_name', 'message_type_code', 'message_type_status'
    );
}
