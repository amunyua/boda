<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class BroadcastController extends Controller
{
    public function sendBroadcast($type,$recipient,$message){
        switch ($type){
            case 'SMS':
                $this->sendSms();
                break;
            case 'EMAIL':

                break;
        }
    }

    public function sendSms(){

        $client = new Client();
        $request = new \GuzzleHttp\Psr7\Request('POST','https://api.infobip.com/sms/1/text/single',array(
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'authorization' => 'Basic bmlhbW9qYTpUZXN0MTIzNA=='
        ),'{  
           "from":"InfoSMS",
           "to":"254715862938",
           "text":"Test SMS."
        }');
        try {
            Log::info('sending sms');
            $response = $client->send($request);
            echo $response->getBody();
        } catch (BadResponseException $ex) {
            Log::critical('Failed'.$ex->getMessage());
            $response = $ex->getMessage();
        }
        return Response::json($response);

    }

    public function addJob(){
        dispatch(new \App\Jobs\SendNotification);
    }
}
