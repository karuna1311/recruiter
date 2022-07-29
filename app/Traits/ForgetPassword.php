<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Events\LoggingEvent;
use Illuminate\Support\Facades\Route;

trait ForgetPassword
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
    public function reset(Request $request)
    {
        
    }
}
