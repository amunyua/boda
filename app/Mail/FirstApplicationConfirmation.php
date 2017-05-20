<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FirstApplicationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plain_pass;

    /**
     * Create a new message instance.
     *
     * @param $user
     */
    public function __construct($user, $plain_pass)
    {
        $this->user = $user;
        $this->plain_pass = $plain_pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail');
    }
}
