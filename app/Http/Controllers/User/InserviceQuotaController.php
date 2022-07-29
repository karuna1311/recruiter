<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\InserviceQuotaRequest;
use App\Models\MasterPgd;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Response;
use Auth;
use Gate;

class InserviceQuotaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inservice_quota'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $inserviceData=MasterPgd::select('id','inservice_quota','inservice_establishment','inservice_join_date','inservice_posting_addr','inservice_establish_noc','inservice_establish_noc_date','inservice_dept_enquiry','inservice_dept_enquiry_details')->first();
        return view('user.ApplicationForm.InserviceQuota',compact('inserviceData'));
    }
    public function create()
    {
        //
    }
    public function store(InserviceQuotaRequest $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(InserviceQuotaRequest $request, MasterPgd $inserviceQuotum)
    {
        //print_r($request->all());die();
        try {
            $updatetInserviceQuota = $inserviceQuotum->update($request->validated());
            $user=Auth::user();
            if($user->application_status < 3) User::where('id',$user->id)->update(['application_status'=>'3']);
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
