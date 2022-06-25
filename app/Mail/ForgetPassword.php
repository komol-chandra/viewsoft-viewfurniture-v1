<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $verify_id;

    public function __construct($code,$verify_id)
    {
        $this->code = $code;
        $this->verify_id = $verify_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $code=$this->code;
        $verify_id=$this->verify_id;
        return $this->subject('Mail from')->view('frontend.mailsend.forgetpassMail',compact('code','verify_id'));

    }
}
