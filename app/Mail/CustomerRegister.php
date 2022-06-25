<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerRegister extends Mailable
{
    use Queueable, SerializesModels;

   
    public $verification_code;
    public $email;
    public $name;

    public function __construct($verification_code,$email,$name)
    {
        $this->verification_code = $verification_code;
        $this->email = $email;
        $this->name = $name;
    
    }
    public function build()
    {   
        $varification=$this->verification_code;
        $email=$this->email;
        $name=$this->name;
        return $this->subject('Mail from')->view('frontend.mailsend.customerregister',compact('varification','email','name'));
    }
}
