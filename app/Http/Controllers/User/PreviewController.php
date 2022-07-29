<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Models\MasterPgd;
use App\Models\User;
use Auth;
use Response;
use Exception;
use Gate;

class PreviewController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('preview'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $previewData=MasterPgd::first(); 
        $user=Auth::user();
        $userData = ['name'=>$user->name,'mobile'=>$user->mobile,'email'=>$user->email,'dob'=>$user->dob,'rollno'=>$user->rollno,'neetappno'=>$user->neetappno,'neet_marks'=>$user->neet_marks,'arank'=>$user->arank];
        return view('user.ApplicationForm.Preview',compact('previewData','userData'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
    }
    public function show($id)
    {
        //
    }
    public function edit(MasterPgd $preview)
    {

    }
    public function update(MasterPgd $preview)
    {
        try {
            $user=Auth::user();
            if($user->application_status < 7) User::where('id',$user->id)->update(['application_status'=>'7']);
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return redirect()->route('declaration.index');
    }
    public function destroy($id)
    {
        //
    }
}
