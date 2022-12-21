<?php

namespace App\Http\Controllers\User;

use Gate;
use DateTime;
use DB;
use Response;
use Carbon\Carbon;
use App\Models\Jobs;
use App\Models\User;
use App\Models\lookup;
use App\Traits\convertors;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\UserExperience;
use App\Models\UserReservation;
use App\Models\AppliedJobByUser;
use App\Models\UserQualification;
use App\Models\EligibleCandidates;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AppliedJobByUserExperience;
use App\Models\AppliedJobByUserQualification;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

use App\Services\JobApplicationService;

class PostAvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getUserID()
    {
        return Auth::user()->id;         
    }

    public function index()
    {
        abort_if(Gate::denies('postavailable'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');

        $applied_array = array();
        $job_array = array();
        $jobs = Jobs::get();

   
        foreach($jobs as $value)
        {   
      
           $start_date =  (isset($value->start_date)) ? $value->start_date : 'NULL';
           $end_date =  (isset($value->end_date)) ? $value->end_date : 'NULL';
          
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));   
              
            if($start_date==='NULL' && $end_date==='NULL')
            {
         
                $availableJobs = Jobs::select('id','name','year')->where('start_date',NULL)
                                            ->where('end_date',NULL)
                                            ->where('id',$value->id)
                                                ->first();      
                                                
                                                $data = [
                                                    'id' => $availableJobs->id,
                                                    'name' => $availableJobs->name,
                                                    'year' => $availableJobs->year,
                                                ];
                    array_push($job_array,$data); 
             
            }else if(isset($start_date) && isset($end_date))
            {   
                                  
                  if(($currentDate >= $start_date) && ($currentDate <= $end_date)){
                    $availableJobs = Jobs::select('id','name','year')
                                            ->where('start_date',$value->start_date)
                                            ->where('end_date',$value->end_date)
                                            ->where('id',$value->id)
                                            ->first(); 
                    $data = [
                        'id' => $availableJobs->id,
                        'name' => $availableJobs->name,
                        'year' => $availableJobs->year,
                    ];
                    array_push($job_array,$data);     
                  }                             
            }                   
        }
        
        $eligible_candidates = EligibleCandidates::Select('applied_job_by_user.job_id')
        ->join('applied_job_by_user','applied_job_by_user.eligible_cand_id','=','eligible_candidates.id')
        ->where(
            [
                'eligible_candidates.status' => 1,
                'eligible_candidates.user_id' => self::getUserID()
            ])  ->get();

                               
        foreach($eligible_candidates as $value){
            array_push($applied_array,$value->job_id);
        }                            
        return view('user.ApplicationForm.PostAvailable',compact('job_array','applied_array'));
    }
    public function checkJobAvailability($enc_id)
    {
        abort_if(Gate::denies('postavailable'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $user_id = $this->getUserID();

        $job_id = base64_decode($enc_id);

        $job_exists = Storage::disk('json')->exists('criteria/json/'.$job_id.'.json');
         
        if($job_exists==true)
        {
            $job =json_decode(Storage::disk('json')->get('criteria/json/'.$job_id.'.json'),true);
            $studentdata = UserReservation::with(['qualification'])
            ->where('user_reservation.user_id',$user_id)
            ->first()->toArray();

            // This query sums candidate all designation with years
            $experience_sql_query = DB::select(DB::raw('select jobNatureLookupId, postNameLookupId,SUM(expYears),
            SUM(expMonths), CASE WHEN SUM(expMonths) = 12
            THEN ROUND(SUM(expYears) +(SUM(expMonths) / 12),0) WHEN SUM(expMonths) > 12
            THEN SUM(expYears) +ROUND((SUM(expMonths) / 12),1) WHEN SUM(expMonths) < 12 
            THEN CONCAT(SUM(expYears),".",sum(expMonths)) END as total_exp_year  
            FROM `user_experience` WHERE `user_id` = '.$user_id.' and `deleted_at` is null 
            GROUP BY jobNatureLookupId,postNameLookupId ORDER BY postNameLookupId'));

            $experience = json_decode(json_encode($experience_sql_query), true);
        
            array_push($studentdata,['experience' => $experience]);
       
            $job_id = base64_decode($enc_id);
            $checkEligibity=JobApplicationService::checkEligibity($studentdata,$job_id);

            $checkCandidate =  EligibleCandidates::where('user_id', '=',$user_id)
                                                    ->where('job_id', '=',$job_id)
                                                    ->exists();

            if($checkCandidate == true && $checkEligibity['status'] == 'success')           // candidate have entry already,but eligible for job
            {
                $store =   EligibleCandidates::where('user_id', '=',$user_id)
                                    ->where('job_id', '=',$job_id)
                                    ->update(['status' => 1]);

            }else if($checkCandidate == true && $checkEligibity['status'] != 'success')     // candidate have entry already,but not eligible for job
            {
                $store =   EligibleCandidates::where('user_id', '=',$user_id)
                                        ->where('job_id', '=',$job_id)
                                        ->update(['status' => 0]);

            }else if($checkCandidate == false && $checkEligibity['status'] == 'success')    // candidate  doesn't have entry ,but eligible for job
            {
                $store =   EligibleCandidates::insert([
                                                        'user_id' => $user_id,
                                                        'job_id' => $job_id,
                                                        'status' => 1
                                                    ]);                                   
            }else if($checkCandidate == false && $checkEligibity['status'] != 'success')    // candidate  doesn't have entry ,and doesn't eligible for job
            {
                $store =   EligibleCandidates::insert([
                                                        'user_id' => $user_id,
                                                        'job_id' => $job_id,
                                                        'status' => 0
                                                    ]); 
            }

        return $checkEligibity; 

        }else
        {
            return Response::json(['status'=>'error','data'=>'Crietria Not set By Admin']); 
        }


        //$checkEligibity_qualification=JobApplicationService::checkEligibity($studentdata->qualification,$job_id);

        // echo "<pre>";
        // print_r($checkEligibity);die();
    }


    public function checkPostAvailable(){
        try 
        {            
            $user=Auth::user();
            $user_id = $user->id;

            $check = EligibleCandidates::join('applied_job_by_user','applied_job_by_user.job_id','=','eligible_candidates.job_id')
            ->where('eligible_candidates.status',1)->where('eligible_candidates.user_id',$user_id)->exists();
            
            if($user->status_lock == '0'){               
            
                    if($check == true){                        
                        return redirect()->route('preview.index');
                    }else{
                        return redirect()->route('postavailable.index')->with('msg_error','Please be Eligible and Apply for One Post');
                    }
             
            }else if($user->status_lock =='1'){
                if($check == true){
                    return redirect()->route('preview.index');
                }
                    return redirect()->route('postavailable.index')->with('msg_error','Your account is locked, please first unlocked it.');                
            }            
        }
        catch(Exception $e) {
            return redirect()->route('postavailable.index')->with('msg_error',$e->getMessage());
        }
    }  
  
    public function applyJob($id)
    {
        abort_if(Gate::denies('postavailable'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');

        $job_id = base64_decode($id);
        $user_id = $this->getUserID();
        $year = date('Y');
        $lastyear = substr($year, -2);
        $randomkey = mt_rand(111111,999999);
        $application_no = $lastyear.$job_id.$randomkey;

        $exists = EligibleCandidates::where('user_id', '=',$user_id)
                                        ->where('job_id', '=',$job_id)
                                        ->where('status','=', 1)
                                        ->exists();

        $getInsertedId = EligibleCandidates::select('id')
                                            ->where('user_id', '=',$user_id)
                                            ->where('job_id', '=',$job_id)
                                            ->where('status','=', 1)
                                            ->first();
        if($exists)
        {
            //true means candidate is eligible with job
            $basic_user_data = UserReservation::Select('*')->where('user_id',$user_id)->first();
            $qual_user_data = UserQualification::Select('*')->where('user_id',$user_id)->get();
            $exp_user_data = UserExperience::Select('*')->where('user_id',$user_id)->get();

            $json_basic_user = json_encode($basic_user_data);
            $json_qual_user = json_encode($qual_user_data);
            $json_exp_user = json_encode($exp_user_data);

         
            $user_data = new AppliedJobByUser();
            $user_data->user_id             =    $user_id;           
            $user_data->job_id              =    $job_id;                          
            $user_data->eligible_cand_id    =    $getInsertedId->id;                          
            $user_data->json                =    $json_basic_user; 
            $user_data->application_no      =     $application_no;    
            $user_data->save();
            $LastInsertId                   =      $user_data->id ; 


           
           $user_qualification_data = AppliedJobByUserQualification::Insert([
                                                                                'user_id' => $user_id,
                                                                                'job_id' => $job_id,
                                                                                'json' => $json_qual_user,
                                                                                'applied_job_id' => $LastInsertId
                                                                            ]);

                
           $user_experience_data =  AppliedJobByUserExperience::Insert([
                                                                            'user_id' => $user_id,
                                                                            'job_id' => $job_id,
                                                                            'json' => $json_exp_user,
                                                                            'applied_job_id' => $LastInsertId
                                                                        ]);

            if($user_data == true && ($user_qualification_data == true || $user_experience_data ==true ))
            {
                User::where('id',$user_id)->update(['application_status'=>'5']);
                return response()->Json([
                                            'msg'   => 'Success Applied',
                                            'status'     => 'success'
                                        ]);
            }            
        }else
        {
            // return response false candidate is not eligible with job
            return response()->Json([
                                        'msg'   => 'You are not eligible for the job',
                                        'status'     => 'error'
                                    ]);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
