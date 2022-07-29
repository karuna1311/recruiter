<?php

  

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;

class OtpMail extends Mailable

{

    use Queueable, SerializesModels;
    /**

     * Create a new message instance.

     *

     * @return void

     */
    private $otp;
    public function __construct($otp)
    {
          $this->otp=$otp;
    }
    /**

     * Build the message.

     *

     * @return $this

     */
    public function build()
    {
        $otp=$this->otp;
        return $this->view('email.otp',compact('otp'))->subject('OTP');;

    }

}