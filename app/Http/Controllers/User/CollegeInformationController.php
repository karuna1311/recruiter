<?php

namespace App\Http\Controllers\User;
use App\Http\Requests\User\CollegeInformationRequest;
use App\Models\UserReservation;
use App\Models\User;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Response;
use Auth;
use Gate;

class CollegeInformationController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('pre_college_info'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $diplomaSubjectList=config('collegeinfo.DIPLOMA_SUBJECT');
        $collegeInfoData=UserReservation::select('id','mbbs_passing_date','mbbs_agg_per','mbbs_internship_date','mci_reg_diploma','diploma_subject','mci_reg_degree','degree_subject','mbbs_dc_in_mh_or_aiims','mbbs_college_type','mbbs_college_name','mbbs_college_outoff_ind_mah','mbbs_college_ind_mah','mbbs_university_ind_mah','aiee','bond_service','bond_service_undertaking','caste_cert_appli_issue_taluka','caste_validity','caste_validity_no','caste_validity_issue_district','caste_validity_appli_no','neet_pg_attempt_year','domicle_maharashtra','nriq')->first();
        return view('user.ApplicationForm.CollegeInformation',compact('collegeInfoData','diplomaSubjectList'));
    }
    public function create()
    {
        //
    }
    public function store(CollegeInformationRequest $request)
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
    public function update(CollegeInformationRequest $request,UserReservation $collegeInfo)
    {
        // print_r($request->all());die();
        try {
            $updatetCollegeInfo = $collegeInfo->update($request->validated());
            $user=Auth::user();
            if($user->application_status < 4) User::where('id',$user->id)->update(['application_status'=>'4']);
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
