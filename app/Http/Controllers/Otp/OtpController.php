<?php

namespace App\Http\Controllers\Otp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MobileSms;
use App\Services\emailService;
use App\Traits\OtpGenerator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Mail\OtpMail;
use Mail;
use Response;
use Exception;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $input=$request->input;
        $otp=$this->randomOtp();
        if(is_numeric($input))$response=$this->mobileOtp($otp,$input); else $response=$this->emailOtp($otp,$input);
        if($response=='success'){
            $status='success';
            if(!config('sms.otp_visibility')) $otp=Crypt::encryptString($input.'|'.$otp); else $otp=$input.'|'.$otp;
            $data=$otp;
        }else{
            $status='error';
            $data=$response;
        }
        return Response::json(['status'=>$status,'data'=>$data]);
    }
    public function mobileOtp($otp,$mobile){
        $msg='Dear applicant, Your OTP:- '.$otp.' from '.env('APP_NAME').' - Powered by SMB';
        $response=MobileSms::sendSms($msg,$mobile,config('sms.templateId.otp'));
        $response=explode("|",$response);
        if($response[0]=='SUBMIT_SUCCESS ') return'success'; else return $response[0]; 
    }
    public function emailOtp($otp,$email)
    {
        try{
            $OtpMail = new OtpMail($otp);
            $response=Mail::to($email)->send($OtpMail);
            return'success';
        }catch(Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }
    public function verifyOtp(Request $request)
    {
        $sentOtp=$request->sentOtp;
        $enteredOtp=$request->enteredOtp;
        $input=$request->input;
        if(!config('sms.otp_visibility')) {
            try {
                $decryptedString=explode('|',Crypt::decryptString($sentOtp));
            }catch(DecryptException $e) {
                return Response::json(['status'=>'error','data'=>'Unauthorised action']);
            }
        }else $decryptedString=explode('|',$sentOtp);         
        $ogInput=$decryptedString[0];
        $sentOtp=$decryptedString[1];
        if(($sentOtp!= $enteredOtp) || ($ogInput !=$input)) return Response::json(['status'=>'error','data'=>'Otp verification failed']);

        if(!config('sms.otp_visibility')) $data=Crypt::encryptString($ogInput.'|'.$sentOtp.'|success'); else $data=$ogInput.'|'.$sentOtp.'|success';
        return Response::json(['status'=>'success','data'=>$data]);
    }
    public static function otpVerificationCheck($encryptMobileOtp,$encryptEmailOtp,$mobile,$mobileOtp,$email,$emailOtp)
    {
        if(!config('sms.otp_visibility')){
            try{
                $encryptMobileOtp=Crypt::decryptString($encryptMobileOtp);
                $encryptEmailOtp=Crypt::decryptString($encryptEmailOtp);
            }catch(DecryptException $e){
                return ['status'=>'error','data'=>'Unauthorised activity1'];
            }
        }
        $encryptMobileOtp=explode('|',$encryptMobileOtp);
        $encryptEmailOtp=explode('|',$encryptEmailOtp);

        if((count($encryptMobileOtp)!=3) || ($encryptMobileOtp[0]!=$mobile) || ($encryptMobileOtp[1]!=$mobileOtp) || ($encryptMobileOtp[2]!='success')){
            return ['status'=>'error','data'=>'Unauthorised activity2'];
        }
        if((count($encryptEmailOtp)!=3) || ($encryptEmailOtp[0]!=$email) || ($encryptEmailOtp[1]!=$emailOtp) || ($encryptEmailOtp[2]!='success')){
            return ['status'=>'error','data'=>'Unauthorised activity3'];
        }
        return ['status'=>'success'];
    }
    public function randomOtp()
    {
        $number = '1234567890';
        $otp = array(); //remember to declare $pass as an array
        $alphaLength = strlen($number) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $otp[] = $number[$n];
        }
        return implode($otp); //turn the array into a string
    }
}
