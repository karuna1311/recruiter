<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DeclarationRequest;
use App\Models\MasterPgd;
use App\Models\User;
use Auth;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Response;
use Exception;
use Gate;

class DeclarationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('declaration'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $declarationData=MasterPgd::select('id','declaration_status')->first(); 
        return view('user.ApplicationForm.Declaration',compact('declarationData'));
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
    public function edit(DeclarationRequest $request,MasterPgd $declaration)
    {

    }
    public function update(DeclarationRequest $request, MasterPgd $declaration)
    {
        try {
            $updatetDeclaration = $declaration->update(['declaration_status'=>'1','status_lock'=>'1']);
            $user=Auth::user();
            if($user->application_status < 8) User::where('id',$user->id)->update(['application_status'=>'8']);
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
