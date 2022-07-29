<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewlyRegisteredEvent;
use App\Mail\RegistrationMail;
use Mail;
use App\Services\MobileSms;

class SendWelcomeMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewlyRegisteredEvent $event)
    {
        $user = $event->user;
        $RegistrationMail = new RegistrationMail($user);
        Mail::to($user['email'])->send($RegistrationMail);
        $mobile=$user['mobile'];
        $msg='Congratulations '.$user['name'].' ,You have successfully registered. Your User-id is '.$mobile.' or '.$user['email'].' and Password is '.$user['password'].' Keep this information for further reference or login - Powered by SMB';
        $response=MobileSms::sendSms($msg,$mobile,config('sms.templateId.registration'));
    }
}
