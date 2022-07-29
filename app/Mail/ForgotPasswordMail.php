<?php

  

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordMail extends Mailable

{

    use Queueable, SerializesModels;
    /**

     * Create a new message instance.

     *

     * @return void

     */
    private $credentials;
    public function __construct(array $user)
    {
          $this->user=$user;
    }
    /**

     * Build the message.

     *

     * @return $this

     */
    public function build()
    {
        $user=$this->user;
        return $this->view('email.ForgotPassword',compact('user'))->subject(env('APP_NAME').' LOGIN DETAILS');
    }

}