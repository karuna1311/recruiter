<?php

namespace App\Http\Controllers\Auth;

use DB;
use Session;
use Storage;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\InstructionsService;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }   

    public  function loginInstructions($id)
    {
        try{
          $instructionData=InstructionsService::getLoginInstructionById($id);
          //print_r($instructionData);die();
          $html='<ul class="steps steps-vertical mt-4 stepsOverflow">';
          $i=0;
          foreach($instructionData as $data){
              if($data['isDownloadable']){
                  $pdfRoute=route('instructions.downloadFile',[$data['fileUrl']]);

                  $html.='<li class="step-item "><button href="#" class="step-link">
                        <span class="step-number">'.++$i.'</span>
                        <span class="step-title"><a href="'.$pdfRoute.'" target="_blank">'.$data['descriptionEng'].'</a><br>
                          <span class="text-muted">'.$data['descriptionDev'].'</span></span>
                      </button></li>';
              }
              else{
                  $html.='<li class="step-item "><button href="#" class="step-link">
                      <span class="step-number">'.++$i.'</span>
                        <span class="step-title">'.$data['descriptionEng'].'<br>
                          <span class="text-muted">'.$data['descriptionDev'].'</span>
                        </span></button> <li>';
              }
          }
          $html.='</ul>';
        }catch(\Exception $e){
          return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>$html]);
    }
 
    public function login(Request $request)
    {
      
      try
      {      
      $username = self::username();
      $msg = [
        'username.required' => 'The email field is required',
        'username.email' => 'Invalid Email format',
      ];
      switch ($username) {
        case 'email':
          
                   $this->validate($request, [
                        'username'           => 'required|max:255|email',
                        'password'           => 'required'
                      ],$msg);
            $user = DB::table('users')->where('email', $request->input('username'))->first();
            if (Auth::attempt(['email' => request()->input('username'), 'password' => $request->password]) )
                  {

                    $new_sessid   = Session::getId();
              
                    if($user->session_id != '') 
                    {
                          $last_session = Session::getHandler()->read($user->session_id);       
                          if ($last_session) {
                              if (Session::getHandler()->destroy($user->session_id)) {
                                  
                              }
                          }
                    }

                    DB::table('users')->where('id', $user->id)->update(['session_id' => $new_sessid]);          
                      // Success
                      return Response::json(['status'=>'success','data'=>'Login successfully']);
                  } else {
                      return Response::json(['status'=>'error','data'=>'Wrong Credential']);
                  }
          break;
        case 'mobile':
                $this->validate($request, [
                    'username'           => 'required|numeric|min:10',
                    'password'           => 'required',
                ],$msg);
        $user = DB::table('users')->where('mobile', $request->input('username'))->first();

        if (Auth::attempt(['mobile' => request()->input('username'), 'password' => $request->password])) 
        {
          $new_sessid   = Session::getId();
              
            if($user->session_id != '') 
            {
                  $last_session = Session::getHandler()->read($user->session_id);       
                  if ($last_session) {
                      if (Session::getHandler()->destroy($user->session_id)) {
                          
                      }
                  }
            }

            DB::table('users')->where('id', $user->id)->update(['session_id' => $new_sessid]);
            
            // Success
            return Response::json(['status'=>'success','data'=>'Login successfully']);
          } else {
            return Response::json(['status'=>'error','data'=>'Wrong Credential']);
        }
          
          break;          
        default:
        $this->validate($request, [
          'username'           => 'required|max:255|email',
          'password'           => 'required'
        ],$msg);

        $user = DB::table('users')->where('email', $request->input('username'))->first();

      if (Auth::attempt(['email' => request()->input('username'), 'password' => $request->password]) )
          {
            $new_sessid   = Session::getId();
              
            if($user->session_id != '') 
            {
                  $last_session = Session::getHandler()->read($user->session_id);       
                  if ($last_session) {
                      if (Session::getHandler()->destroy($user->session_id)) {
                          
                      }
                  }
            }

            DB::table('users')->where('id', $user->id)->update(['session_id' => $new_sessid]); 
              // Success
              return Response::json(['status'=>'success','data'=>'Login successfully']);
          } else {
              return Response::json(['status'=>'error','data'=>'Wrong Credential']);
          }
      }

      }catch(\Exception $e){
        return Response::json(['status'=>'error','data'=>'Please provide only Mobile/Email']);
      }
  
    }

    public function username()
    {
        $login = request()->input('username');

        if(is_numeric($login)){
            $field = 'mobile';
        } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }else{
          return Response::json(['status'=>'error','data'=>'Please provide only Mobile/Email']);
        }
        return $field;
    }
}
