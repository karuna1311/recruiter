<?php

namespace App\Observers;

use App\Models\User;
use App\Mail\RegistrationMail;
use Mail;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return void
     */

    public function created(User $User)
    {
        //print_r($User);die();
        $credentials=['name'=>$User->name,'mobile'=>$User->mobile,'email'=>$User->email,'password'=>$User->password];
        $RegistrationMail = new RegistrationMail($credentials);
        Mail::to($User->email)->send($RegistrationMail);
    }
}
