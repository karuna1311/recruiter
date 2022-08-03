<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PersonalInfoRequest;
use App\Models\MasterPgd;
use App\Models\User;
use App\Http\Controllers\Location\LocationController;
use Auth;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Response;
use Exception;
use Gate;

class PersonalInformationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('personal_info'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $personalInfoData=MasterPgd::select('id','cname_change','cname_change_value','fname','mname','gender',
        'alternate_mobile','adhar_card_no','permanent_address_1','permanent_address_2',
        'permanent_address_3','permanent_city',
        'permanent_state','permanent_district','permanent_taluka','permanent_pin_code',        
        'address_not_same',
        'present_address_1','present_address_2','present_address_3','present_city',
        'present_state','present_district','present_taluka','present_pin_code')
     
        ->first();
       
        $user=Auth::user();
        $userData = ['name'=>$user->name,'mother_name'=>$user->mother_name,'mobile'=>$user->mobile,'email'=>$user->email,'dob'=>$user->dob];
        $stateData = LocationController::getState();
        $districtData = LocationController::getDistrict($personalInfoData->permanent_state);
        $talukaData = LocationController::getSubDistrict($personalInfoData->permanent_district);
        
        return view('user.ApplicationForm.PersonalInformation',compact('stateData','districtData','talukaData','userData','personalInfoData'));
    }
    public function create()
    {
        //
    }
    public function store(PersonalInfoRequest $request)
    {
        try {
            $user=Auth::user();
            $insertPersonalInfo = MasterPgd::create($request->validated());
            User::where('id',$user->id)->update(['application_status'=>'1']);
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data submitted successfully']);
    }
    public function show($id)
    {
        //
    }
    public function edit(PersonalInfoRequest $request,MasterPgd $MasterPgd)
    {

    }
    public function update(PersonalInfoRequest $request, MasterPgd $personalInfo)
    {
        //print_r($request->validated());die();
        try {
            $updatetPersonalInfo = $personalInfo->update($request->validated());
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
