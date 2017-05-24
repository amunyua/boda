<?php

namespace App\Http\Controllers;

use App\Jobs\SendSMS;

class BroadcastController extends Controller
{
    public function sendSms($phone_number, $message_body){

        $this->dispatch(new SendSMS($phone_number,$message_body));

    }
}
