<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Models\User;
use App\Events\NewlyRegisteredEvent;
use Response;
use App\Mail\ForgotPasswordMail;
use Mail;
use App\Services\MobileSms;
use Exception;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    public function reset(ForgetPasswordRequest $request)
    {
        $dob=date('d-m-Y',strtotime($request->dob));
        $userName=$request->username;
        $user=User::where('dob',$dob)->where('email',$userName)->orWhere('mobile',$userName)->first();
        if(!$user) return Response::json(['status'=>'error','data'=>'Invalid details']);
        $user=['name'=>$user->name,'mobile'=>$user->mobile,'email'=>$user->email,'password'=>base64_decode($user->base64_pwd)];   
        try{
            $ForgotPasswordMail = new ForgotPasswordMail($user);
            Mail::to($user['email'])->send($ForgotPasswordMail);
            $mobile=$user['mobile'];
            $msg='Dear '.$user['name'].',Your username:- '.$user['email'].' and password:- '.$user['password'].' from '.env('APP_NAME').'- Powered by SMB';
            $response=MobileSms::sendSms($msg,$mobile,config('sms.templateId.candidateDetails'));
        }catch(Exception $e){
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
       return Response::json(['status'=>'success','data'=>'Passowrd has been sent to email and mobile successfully']);
    }
}
