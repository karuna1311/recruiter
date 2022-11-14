<?php

namespace App\Http\Controllers\Auth;

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
          $html='<ul class="steps steps-vertical mt-4 stepsOverflow">';
          $i=0;
          foreach($instructionData as $data){
              if($data['isDownloadable'])
              {
                  $pdfFile=(Storage::disk('uploads')->exists('Instructions/files/'.$data['fileUrl'])) ? base64_encode(Storage::disk('uploads')->get('Instructions/files/'.$data['fileUrl'])) : '';
                  $html.='<li class="step-item "><button href="#" class="step-link">
                        <span class="step-number">'.++$i.'</span>
                        <span class="step-title"><a href="data:application/pdf;base64 ,'.$pdfFile.'" download="'.$data['fileUrl'].'">'.$data['descriptionEng'].'</a><br>
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
          return Response::json(['status'=>'error','data'=>$e->getMssage()]);
        }
        return Response::json(['status'=>'success','data'=>$html]);
    }

    public function login(Request $request)
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
            if (Auth::attempt(['email' => request()->input('username'), 'password' => $request->password]) )
                  {
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
        
        if (Auth::attempt(['mobile' => request()->input('username'), 'password' => $request->password])) 
        {
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
      if (Auth::attempt(['email' => request()->input('username'), 'password' => $request->password]) )
          {
              // Success
              return Response::json(['status'=>'success','data'=>'Login successfully']);
          } else {
              return Response::json(['status'=>'error','data'=>'Wrong Credential']);
          }
      }
  
    }

    public function username()
    {
        $login = request()->input('username');

        if(is_numeric($login)){
            $field = 'mobile';
        } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } 
        return $field;
    }
}
