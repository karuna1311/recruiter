<?php

namespace App\Http\Controllers\user; 

use Gate;
use Response;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\DeclarationRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class DeclarationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('declaration'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $user=Auth::user();
      
        if(Storage::disk('uploads')->exists('photo/'.$user->photo)){
            $photo=base64_encode(Storage::disk('uploads')->get('photo/'.$user->photo));
        }else{
            // $photo=base64_encode(Storage::disk('uploads')->get('photo/No_image_available.svg'));
            $photo='';
        }
        if(Storage::disk('uploads')->exists('signature/'.$user->sign)){
            $sign=base64_encode(Storage::disk('uploads')->get('signature/'.$user->sign));
        } else{
            // $sign=base64_encode(Storage::disk('uploads')->get('signature/No_image_available.svg'));
            $sign='';
        }
        
        return view('user.ApplicationForm.Declaration',compact('user','photo','sign'));
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
    public function edit()
    {

    }
    public function update(DeclarationRequest $request,$token)
    {
     
        try {
            $user=Auth::USER();
            $user_id = $user->id;
            
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
            
            Storage::disk('uploads')->put('/photo/'.$imgNameToStore,file_get_contents($request->img));       
            Storage::disk('uploads')->put('/signature/'.$signNameToStore,file_get_contents($request->sign));
        
            $id = base64_decode($token);
    
            $user = User::find($id);
            $user->declare1 = '1';
            $user->declare2 = '1';
            $user->declare3 = '1';
            $user->declare4 = '1';
            $user->declare5 = '1';
            $user->application_status = '7';
            $user->status_lock = '1';
            $user->photo = $imgNameToStore;
            $user->sign = $signNameToStore;
            $user->save();
        
        }else{
            $id = base64_decode($token);
            $user = User::find($id);
            $user->application_status = '7';
            $user->status_lock = '1';
            $user->save();
        }
         
            
            
        }
        catch(QueryException $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data submitted successfully']);
    }
    public function destroy($id)
    {
        //
    }
}
