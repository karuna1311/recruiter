<?php

namespace App\Http\Controllers\User;
use Auth;
use Gate;
use Response;
use Exception;
use App\Models\User;
use App\Models\lookup;
use Illuminate\Http\Request;
use App\Models\UserExperience;
use App\Models\UserReservation;
use App\Models\UserQualification;
use App\Http\Controllers\Controller;
use App\Models\AppliedJobByUser;
use App\Models\EligibleCandidates;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


class PreviewController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('preview'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $user=Auth::user();
        $previewData=UserReservation::where('user_id',$user->id)->first(); 

        $qualification = UserQualification::where('user_id',$user->id)->Select('user_qualification.id','user_qualification.typeResult','user_qualification.doq',
        'user_qualification.attempts','user_qualification.percentage','user_qualification.compulsorySubjects',
        'user_qualification.optionalSubjects','subject.subject_name as subject_name','university.name as university_name','class.label as class',
        'mode.label as mode','qualificationtype.qualification_type_name as qualification_type','qualificationname.qualification_name as qualification_name')->where('user_id',$user->id)
        ->leftjoin('qualificationtype','user_qualification.qualificationtype','=','qualificationtype.qualification_type_code')
        ->leftjoin('qualificationname','user_qualification.qualificationname','=','qualificationname.qualification_name_code')
        ->leftjoin('subject','user_qualification.subject','=','subject.id')
        ->leftjoin('university','user_qualification.university','=','university.id')
        ->leftjoin('lookup_options as class','user_qualification.classGrade','=','class.id')
        ->leftjoin('lookup_options as mode','user_qualification.mode','=','mode.id')
        ->get();

        $experience = UserExperience::where('user_id',$user->id)->Select('user_experience.id as id','employmentType','post.label as post_name','officeName'
        ,'designation','job_nature.label as job_nature','appointment.label as appointment','time','appointmentLetterNo',
        'letterDate','payScale','gradePay','basicPay','monthlyGrossSalary','fromDate','toDate','expYears','expMonths','expDays'
        )
        ->leftjoin('lookup_options as post','user_experience.postNameLookupId','=','post.id')
        ->leftjoin('lookup_options as job_nature','user_experience.jobNatureLookupId','=','job_nature.id')
        ->leftjoin('lookup_options as appointment','user_experience.apointmentNatureLookupId','=','appointment.id')
        ->get();
    
        $job_applied = AppliedJobByUser::Select('job_adv.name','job_adv.year','eligible_candidates.status','applied_job_by_user.application_no','applied_job_by_user.payment_status')
        ->join('eligible_candidates','applied_job_by_user.eligible_cand_id','=','eligible_candidates.id')
        ->join('recruiter_admin.job_adv','job_adv.id','=','eligible_candidates.job_id')
        ->where('eligible_candidates.user_id',$user->id)
        ->where('eligible_candidates.status',1)
        ->get();
            
        $userData = ['name'=>$user->name,'mobile'=>$user->mobile,'email'=>$user->email,'dob'=>$user->dob];
        return view('user.ApplicationForm.Preview',compact('previewData','userData','qualification','experience','job_applied'));
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
    public function edit(UserReservation $preview)
    {

    }
    public function update(UserReservation $preview)
    {
        try 
        {
            $user=Auth::user();
            User::where('id',$user->id)->update(['application_status'=>'6']);
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
