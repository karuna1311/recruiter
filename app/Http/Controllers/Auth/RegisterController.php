<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\InstructionsService;
use App\Services\ScheduleMasterService;
use App\Services\RegistrationService;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Otp\OtpController;
use Exception;
use Response;
use RequestIp;
use App\Events\NewlyRegisteredEvent;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function registrationInstructions()
    {
        $instructionData=InstructionsService::parseInstructions('registration');
        return view('auth.RegistrationInstruction',compact('instructionData'));
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(RegistrationRequest $request)
    {
        extract($request->validated());

        $otpVerificationCheck=OtpController::otpVerificationCheck($encryptMobileOtp,$encryptEmailOtp,$mobile,$mobileOtp,$email,$EmailOtp);
        if($otpVerificationCheck['status']=='error') return Response::json($otpVerificationCheck);

        $studentValidation=RegistrationService::studentValidation($rollno,$neetappno,date('d-m-Y',strtotime($dob)));
        if($studentValidation['status']!='success') return Response::json($studentValidation);
        $studentData=$studentValidation['data'];

        $checkSchedule=ScheduleMasterService::checkSchedule('Registration',$studentData->neet_year);
        if($checkSchedule['status']!='success') return Response::json($checkSchedule);

        $password=substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 8);
        try{
            User::create(['name'=>$studentData->cname,'mobile'=>$mobile,'email'=>$email,'dob'=>$studentData->dob,'rollno'=>$studentData->roll_no,'neetappno'=>$studentData->application_no,'arank'=>$studentData->neet_rank,'neet_marks'=>$studentData->neet_score,'neet_year'=>$studentData->neet_year,'password'=>Hash::make($password),'is_active'=>'1','application_status'=>'0','ip_address'=>RequestIp::ip(),'base64_pwd'=>base64_encode($password)]);
            $user=['name'=>$studentData->cname,'mobile'=>$mobile,'email'=>$email,'password'=>$password];   
            event(new NewlyRegisteredEvent($user));
        }catch(Exception $e){
            return ['status'=>'error','data'=>$e->getMessage()];
        }
        return Response::json(['status'=>'success']);    
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
}
