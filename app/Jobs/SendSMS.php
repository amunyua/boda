<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use infobip;

class SendSMS implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected $phone_number, $message, $from;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone_number, $message)
    {
        $this->phone_number = $phone_number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = "'$this->phone_number'";
        Log::info('qued now for '.$this->phone_number);
        $client = new infobip\api\client\SendSingleTextualSms(new infobip\api\configuration\BasicAuthConfiguration('bodasquared', 'boda12!@'));
        $requestBody = new infobip\api\model\sms\mt\send\textual\SMSTextualRequest();
        $requestBody->setFrom('Voomsms');
//            $requestBody->setTo("'$this->phone_number'");
        $requestBody->setText($this->message);
//            $requestBody->setFrom("VoomSms");
        $requestBody->setTo($data);
//            $requestBody->setText("hello");


        $response = $client->execute($requestBody);
        var_dump($response);die;

    }
    
}
