<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\MedicalCouncilRequest;
use App\Models\MasterPgd;
use App\Models\User;
use Auth;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Response;
use Exception;
use Gate;

class MedicalCouncilController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('medical_council'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $medicalCouncilData=MasterPgd::select('id','medical_council_reg','medical_council_reg_no','medical_dci_reg','medical_dci_reg_no')->first();
        return view('user.ApplicationForm.MedicalCouncil',compact('medicalCouncilData'));
    }
    public function create()
    {
        //
    }
    public function store(PersonalInfoRequest $request)
    {
    }
    public function show($id)
    {
        //
    }
    public function edit(MedicalCouncilRequest $request,MasterPgd $medicalCouncil)
    {

    }
    public function update(MedicalCouncilRequest $request, MasterPgd $medicalCouncil)
    {
        //print_r($request->all());die();
        try {
            $updatetMedicalCouncil = $medicalCouncil->update($request->validated());
            $user=Auth::user();
            if($user->application_status < 5) User::where('id',$user->id)->update(['application_status'=>'5']);
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
