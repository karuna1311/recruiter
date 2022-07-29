<?php

  

namespace App\Jobs;

   

use Illuminate\Bus\Queueable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Foundation\Bus\Dispatchable;

use App\Mail\OtpMail;

use Mail;

class SendOtpEmailJob implements ShouldQueue

{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $details;
    public function __construct(array $details)
    {
        $this->details = $details;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new OtpMail($this->details['otp']);
        Mail::to($this->details['email'])->subject('OTP')->send($email);
    }

}