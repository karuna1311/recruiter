<?php

namespace App\Http\Controllers\user; 

use Response;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\DeclarationRequest;

class DeclarationController extends Controller
{
    public function index()
    {
        
        $user=Auth::user();
        
        // dd(Storage::disk('uploads')->get('recruitment/img/bank_candidate_image/'));
        
        // $user['image'] = isset($user->photo) ? Storage::disk('uploads')->get($user->photo) : '';
        // $user['signed'] = isset($user->sign) ? Storage::disk('uploads')->get('recruitment/img/bank_candidate_sign/') : Storage::disk('json')->get('/img/bank_candidate_image/') ;
            // dd($user->image);
            // dd($user);
        return view('user.ApplicationForm.Declaration',compact('user'));
    }
    public function create()
    {
        //
    }
    public function store(DeclarationRequest $request)
    {
    }
    public function show($id)
    {
        //
    }
    public function edit(DeclarationRequest $request,UserReservation $declaration)
    {

    }
    public function update(DeclarationRequest $request,$token)
    {
        // dd($request->img);
        // dd($request->all());
        try {
            $user=Auth::user();
            $user_id = $user->id();
            $imgNameToStore = null;
            $signNameToStore = null;
          // Handle file Upload
          if($request->hasFile('img') && $request->hasFile('sign')){

            // Get filename with the extension
            $imgnameWithExt = $request->file('img')->getClientOriginalName();
            $signnameWithExt = $request->file('sign')->getClientOriginalName();
            //Get just filename
            $imagename = pathinfo($imgnameWithExt, PATHINFO_FILENAME);
            $signname = pathinfo($signnameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $imgextension = $request->file('img')->getClientOriginalExtension();
            $signextension = $request->file('sign')->getClientOriginalExtension();
            // Filename to store
            $imgNameToStore = $user_id.'_photo_'.time().'.'.$imgextension;
            $signNameToStore = $user_id.'_sign_'.time().'.'.$signextension;
            
            $file = $request->img;
            $sign = $request->sign;

            Storage::disk('uploads')->put('/photo/'.$imgNameToStore,$file);       
            Storage::disk('uploads')->put('/signature/'.$signextension,$sign);
        
        }


            $id = base64_decode($token);
            $user = User::find($id);
            $updatetDeclaration = $user->update(['declare1'=>'1','declare2'=>'1','declare3'=>'1','declare4'=>'1','declare5'=>'1','application_status'=>'6',
        'photo'=>$imgNameToStore,'sign'=>$signNameToStore]);
            // ,'status_lock'=>'1']);
            
            
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data submitted successfully']);
    }
    public function destroy($id)
    {
        //
    }
}
