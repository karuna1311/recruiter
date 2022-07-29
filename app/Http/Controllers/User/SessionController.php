<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Otp\OtpController;
use App\Services\SessionMasterService;
use App\Models\SessionMaster;
use App\Models\MasterPgd;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Response;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Gate;

class SessionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('session_application'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $user=Auth::user();
        $email=$user->email;
        $mobile=$user->mobile;
        $applicationStatus=$user->application_status;
    	$sessionData=SessionMasterService::getActiveSessionWithCutoff();
        return view('user.ApplicationSubmission.Session',compact('sessionData','email','mobile','applicationStatus'));
    }
    public function sessionApply(SessionMaster $id){
    	$isEligible=SessionMasterService::checkEligibity($id);
        if($isEligible['status']!='success') return Response::json($isEligible);
        return Response::json(['status'=>'success','data'=>'Application submitted']);
    }
    public function unlockProfile(Request $request){
    	$otpVerificationCheck=OtpController::otpVerificationCheck($request->encryptMobileOtp,$request->encryptEmailOtp,$request->mobile,$request->mobileOtp,$request->email,$request->emailOtp);
    	if($otpVerificationCheck['status']!='success') return Response::json($otpVerificationCheck);
    	try{
    		$user=Auth::user();
    		$user->application_status='7';
    		$user->save();
    		MasterPgd::where([['user_id',$user->id],['is_active','1']])->update(['status_lock'=>'0','session_master_id'=>'0']);
    		return Response::json(['status'=>'success','data'=>'Unlock success']);
    	}catch(Exception $e){
    		Response::json(['status'=>'error','data'=>$e->getMessage()]);
    	}
    }
}
