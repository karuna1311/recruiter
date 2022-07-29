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
        
        // $otpVerificationCheck=OtpController::otpVerificationCheck($encryptMobileOtp,$encryptEmailOtp,$mobile,$mobileOtp,$email,$EmailOtp);
        // if($otpVerificationCheck['status']=='error') return Response::json($otpVerificationCheck);

        $password=substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 8);
        $data = $request->except('mobileOtp','EmailOtp','encryptMobileOtp','encryptEmailOtp');
        $data['password'] = Hash::make($password);
        $data['base64_pwd'] = $password;
        $data['ip_address'] = RequestIp::ip();
        $data['application_status'] = 0;
      
        try{
            User::create($data);

            $user=['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email'],'password'=>$password];   
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
