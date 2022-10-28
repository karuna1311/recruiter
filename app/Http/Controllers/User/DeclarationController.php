<?php

namespace App\Http\Controllers\user; 

use App\Models\User;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\User\DeclarationRequest;

class DeclarationController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('declaration'), Response::HTTP_FORBIDDEN, '403 Forbidden');        
        $user=Auth::user();
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
        try {
            
          // Handle file Upload
          if($request->hasFile('img') && $request->hasFile('sign')){

            //Storage::delete('/public/avatars/'.$user->avatar);

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
            $imgNameToStore = $imagename.'_'.time().'.'.$imgextension;
            $signNameToStore = $signname.'_'.time().'.'.$signextension;
            
            // Upload Image
            $path = $request->file('img')->storeAs('public/assets/img/bank_candidate_image/',$imgNameToStore);
            $path = $request->file('sign')->storeAs('public/assets/img/bank_candidate_sign/',$signNameToStore);

        }


            $id = base64_decode($token);
            $user = User::find($id);
            $updatetDeclaration = $user->update(['declare1'=>'1','declare2'=>'1','declare3'=>'1','declare4'=>'1','declare5'=>'1','application_status'=>'8',
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
