<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PersonalInfoRequest;
use App\Models\UserReservation;
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
        
        $user=Auth::user();
        
        $personalInfoData=UserReservation::select('id','cname_change','cname_change_value','fname','mname','gender','bankemp','marathispeaking',
        'alternate_mobile','adhar_card_no','permanent_address_1','permanent_address_2',
        'permanent_address_3','permanent_city',
        'permanent_state','permanent_district','permanent_taluka','permanent_pin_code',        
        'address_not_same',
        'present_address_1','present_address_2','present_address_3','present_city',
        'present_state','present_district','present_taluka','present_pin_code')
        ->where('user_id',$user->id)
        ->first();
        
        
        $userData = ['name'=>$user->name,'mother_name'=>$user->mother_name,'mobile'=>$user->mobile,'email'=>$user->email,'dob'=>$user->dob];
        
        
        $permanent_district = (!empty($personalInfoData->permanent_state)) ? $personalInfoData->permanent_state : null;
        $permanent_taluka = (!empty($personalInfoData->permanent_district)) ? $personalInfoData->permanent_district : null;
       
        $stateData = LocationController::getState();
        $districtData = LocationController::getDistrict($permanent_district);
        $talukaData = LocationController::getSubDistrict($permanent_taluka);
        
        
        return view('user.ApplicationForm.PersonalInformation',compact(
            'stateData',
            'districtData',
            'talukaData',
            'userData','personalInfoData'));
    }
    public function create()
    {
        //
    }
    public function store(PersonalInfoRequest $request)
    {
        try {
            $user=Auth::user();
            $exists = UserReservation::where('user_id',$user->id)->exists();
            if($exists==true){
                
            }else{
                $insertPersonalInfo = UserReservation::create($request->validated());
                User::where('id',$user->id)->update(['application_status'=>'1']);
            }
            return Response::json(['status'=>'success','data'=>'Data submitted successfully']);
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        
    }
    public function show($id)
    {
        //
    }
    public function edit(PersonalInfoRequest $request,UserReservation $UserReservation)
    {

    }
    public function update(PersonalInfoRequest $request, UserReservation $personalInfo)
    {
        
        try {
            $user=Auth::user();

            if($user->status_lock =='0'){
                
                $updatetPersonalInfo = $personalInfo->update($request->except('_token'));
            }else{
                return Response::json(['status'=>'error','data'=>'Your account is locked, please first unlocked it.']);    
            }
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data updated successfully']);
    }
    public function destroy($id)
    {
        //
    }
}
