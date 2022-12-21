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
   
        foreach($jobs as $value){   
      
           $start_date =  (isset($value->start_date)) ? $value->start_date : 'NULL';
           $end_date =  (isset($value->end_date)) ? $value->end_date : 'NULL';
          
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));   
              
            if($start_date==='NULL' && $end_date==='NULL'){
         
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
             
            }else if(isset($start_date) && isset($end_date)){   
                                  
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
            ]
        )->get();

                                // dd($eligible_candidates);
        foreach($eligible_candidates as $value){
            array_push($applied_array,$value->job_id);
        }                            
        return view('user.ApplicationForm.PostAvailable',compact('job_array','applied_array'));
    }
    public function checkJobAvailability($enc_id){
        abort_if(Gate::denies('postavailable'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $user_id = $this->getUserID();

        $job_id = base64_decode($enc_id);
// dd($user_id);
        $job_exists = Storage::disk('json')->exists('criteria/json/'.$job_id.'.json');
         
     if($job_exists==true){
        $job =json_decode(Storage::disk('json')->get('criteria/json/'.$job_id.'.json'),true);
         $studentdata = UserReservation::with(['qualification'])
         ->where('user_reservation.user_id',$user_id)
         ->first()->toArray();

        $experience =DB::select(DB::raw('select jobNatureLookupId, postNameLookupId,SUM(expYears), SUM(expMonths), CASE WHEN SUM(expMonths) = 12 THEN ROUND(SUM(expYears) +(SUM(expMonths) / 12),0) WHEN SUM(expMonths) > 12 THEN SUM(expYears) +ROUND((SUM(expMonths) / 12),1) WHEN SUM(expMonths) < 12 THEN CONCAT(SUM(expYears),".",sum(expMonths)) END as total_exp_year  FROM `user_experience` WHERE `user_id` = '.$user_id.' and `deleted_at` is null GROUP BY jobNatureLookupId,postNameLookupId ORDER BY postNameLookupId'));

        $experience = json_decode(json_encode($experience), true);
        
        array_push($studentdata,['experience' => $experience]);
        // echo "<pre>";
        // print_r($studentdata);die();
        $job_id = base64_decode($enc_id);
        $checkEligibity=JobApplicationService::checkEligibity($studentdata,$job_id);

        $checkCandidate =  EligibleCandidates::where('user_id', '=',$user_id)
                                    ->where('job_id', '=',$job_id)
                                    ->exists();

        if($checkCandidate == true && $checkEligibity['status'] == 'success'){
                    $store =   EligibleCandidates::where('user_id', '=',$user_id)
                                        ->where('job_id', '=',$job_id)
                                        ->update(['status' => 1]);
                    }
        else if($checkCandidate == true && $checkEligibity['status'] != 'success'){
              $store =   EligibleCandidates::where('user_id', '=',$user_id)
                                        ->where('job_id', '=',$job_id)
                                        ->update(['status' => 0]);
        }else if($checkCandidate == false && $checkEligibity['status'] == 'success'){
                        $store =   EligibleCandidates::insert([
                            'user_id' => $user_id,
                            'job_id' => $job_id,
                            'status' => 1
                        ]);                                   
        }else if($checkCandidate == false && $checkEligibity['status'] != 'success')
        {
                      $store =   EligibleCandidates::insert([
                                                'user_id' => $user_id,
                                                'job_id' => $job_id,
                                                'status' => 0
                                            ]); 
        }

        return $checkEligibity; 

    }else{
        return Response::json(['status'=>'error','data'=>'Crietria Not set By Admin']); 
    }


        //$checkEligibity_qualification=JobApplicationService::checkEligibity($studentdata->qualification,$job_id);

        // echo "<pre>";
        // print_r($checkEligibity);die();
    }


    public function checkPostAvailable(){
        try {            
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
    
    
    public function match_personal_reservation($criteria,$student_data,$type)
    {      
        $response = array();
        $value = array();
        $error = array();
        $array_criteria = json_decode($criteria);
        $array_student = (array)$student_data;
        $admin_criteri_count = 0;  
        // dd($array_criteria,$array_student);
        $count_success = 0;        
      
        if(strtolower($type)=='or')
        {
            $admin_criteri_count = 1;
                for($i=0;$i<count($array_criteria);$i++)
                {      
                            // echo $array_criteria[$i]->fieldname;
                        $fieldname = strtolower($array_criteria[$i]->fieldname); 
                        $comparison = $array_criteria[$i]->comparison; 
                        $value = strtolower($array_criteria[$i]->value); 

                        if(array_key_exists($fieldname,$array_student) &&($fieldname == array_search($array_student[$fieldname],$array_student))
                        )
                        {
                            if(self::num_cond($value,$comparison,strtolower($array_student[$fieldname])))
                            {                                    
                                $count_success++;                                  
                            }else{
                                // array_push($error,$array_student[$fieldname].' caste candidate is not eligible,Eligible candidate must be '.$value);     
                                if(strtolower($array_criteria[$i]->fieldname) == 'cate'){
                                    array_push($error,$array_student[$fieldname].' caste candidate is not eligible,Eligible candidate must be '.$value);     
                                }else if(strtolower($array_criteria[$i]->fieldname) == 'age'){
                                    array_push($error,'Age '.$array_student[$fieldname].' candidate is not eligible,Eligible candidate must be '. convertors::comparisonName($comparison) .' '.$value);     
                                }else if(strtolower($array_criteria[$i]->fieldname) == 'ph'){
                                    array_push($error,'Physical handicap '.$array_student[$fieldname].' candidate is not eligible,Eligible candidate must be '. convertors::comparisonName($comparison) .' '.$value);     
                                }else if(strtolower($array_criteria[$i]->fieldname) == 'orphan'){
                                    array_push($error,'Orphan '.$array_student[$fieldname].' candidate is not eligible,Eligible candidate must be '. convertors::comparisonName($comparison) .' '.$value);     
                                }
                            }                    
                        } 
                }
        }elseif(strtolower($type)=='and'){
            
            
            for($i=0;$i<count($array_criteria);$i++)
            {      
                    $admin_criteri_count++;
                    
                    $fieldname = strtolower($array_criteria[$i]->fieldname); 
                    $comparison = $array_criteria[$i]->comparison; 
                    $value = strtolower($array_criteria[$i]->value); 

                if(array_key_exists($fieldname,$array_student) &&($fieldname == array_search($array_student[$fieldname],$array_student))
                )
                {      
                
                    if(self::num_cond(strtolower($array_student[$fieldname]),$comparison,$value))
                    {                                    
                        $count_success++;                                  
                    }else{                     
                        if(strtolower($array_criteria[$i]->fieldname) == 'cate'){
                            array_push($error,$array_student[$fieldname].' caste candidate is not eligible,Eligible candidate must be '.$value);     
                        }else if(strtolower($array_criteria[$i]->fieldname) == 'age'){
                            array_push($error,'Age '.$array_student[$fieldname].' candidate is not eligible,Eligible candidate must be '. convertors::comparisonName($comparison) .' '.$value);     
                        }else if(strtolower($array_criteria[$i]->fieldname) == 'ph'){
                            array_push($error,'Physical handicap '.$array_student[$fieldname].' candidate is not eligible,Eligible candidate must be '. convertors::comparisonName($comparison) .' '.$value);     
                        }else if(strtolower($array_criteria[$i]->fieldname) == 'orphan'){
                            array_push($error,'Orphan '.$array_student[$fieldname].' candidate is not eligible,Eligible candidate must be '. convertors::comparisonName($comparison) .' '.$value);     
                        }
                    }                    
                } 
            }
        }

        array_push($response,['per_res_success'=>$count_success,'per_res_error_msg'=>$error,'admin_criteria_count'=>$admin_criteri_count]);
        // dd($response);
        return $response;          
    }


    public function matchjob($criteria,$student_data,$type)
    {      
        $response = array();
        $value = array();
        $error = array();
        $array_criteria = json_decode($criteria);
        $array_student = (array)$student_data;
        $admin_criteri_count = 0;  
    
        $count_success = 0;        
          
        if(strtolower($type)=='or')
        {
            $admin_criteri_count = 1;
                for($i=0;$i<count($array_criteria);$i++)
                {      
                            // echo $array_criteria[$i]->fieldname;
                        $fieldname = strtolower($array_criteria[$i]->fieldname); 
                        $comparison = $array_criteria[$i]->comparison; 
                        $value = strtolower($array_criteria[$i]->value); 

                        if(array_key_exists($fieldname,$array_student) &&($fieldname == array_search($array_student[$fieldname],$array_student))
                        )
                        {
                      
                            if(self::num_cond($value,$comparison,strtolower($array_student[$fieldname])))                            
                            {                                    
                                $count_success++;                                  
                            }else{
                                array_push($error,$array_student[$fieldname].' caste candidate is not eligible,Eligible candidate must be '.$value);     
                            }                    
                        } 
                }
        }elseif(strtolower($type)=='and'){
            $admin_criteri_count++;
            for($i=0;$i<count($array_criteria);$i++)
                {      
                    
                $fieldname = strtolower($array_criteria[$i]->fieldname); 
                $comparison = $array_criteria[$i]->comparison; 
                $value = strtolower($array_criteria[$i]->value); 

                if(array_key_exists($fieldname,$array_student) &&($fieldname == array_search($array_student[$fieldname],$array_student))
                )
                {                    
                    if(self::num_cond($value,$comparison,strtolower($array_student[$fieldname])))                    
                    {                                    
                        $count_success++;                                  
                    }else{
                        array_push($error,$array_student[$fieldname].' caste candidate is not eligible,Eligible candidate must be '.$value);     
                    }                    
                } 
            }
        }

        array_push($response,['res_success'=>$count_success,'res_error'=>$error,'admin_criteria_count'=>$admin_criteri_count]);
    
        return $response;          
    }

    public function matchqualificationjob($criteria,$student_data,$type)
    {

        $count_success = 0;
        $temp_cri = array();
        $temp_stud = array();
        $response = array();
        $error = array();
        $result = array();
        $array_criteria = json_decode($criteria);
        
        if(strtolower($type)=='or'){
            $admin_criteri_count = 1;

            $student_qualification = $student_data->qualification;
                
            for($i=0;$i<count($student_qualification);$i++)
            {  
                for($j=0;$j<count($array_criteria);$j++){
                        
                        $criteria_fieldname = $array_criteria[$j]->fieldname;
                        $criteria_operator = $array_criteria[$j]->comparison;
                        $criteria_value = $array_criteria[$j]->value;
                       
                            if(self::num_cond(strtolower($student_qualification[$i]->$criteria_fieldname),$criteria_operator,strtolower($criteria_value)))
                            {                                    
                                $count_success++; 
                                 
                                if($admin_criteri_count == $count_success){
                                    break 2;
                                }                              
                            }else{
                                $count_success= 0;
                                if(strtolower($criteria_fieldname) === 'qualificationname'){
                                    array_push($error,$student_qualification[$i]->$criteria_fieldname.' qualified candidate is not eligible,Eligible candidate must be '.$criteria_value);     
                                }else if(strtolower($criteria_fieldname) === 'university'){
                                    array_push($error,$student_qualification[$i]->$criteria_fieldname.' University candidate is not eligible,Eligible candidate must be from'.$criteria_value);     
                                }else if(strtolower($criteria_fieldname) === 'typeresult'){
                                    array_push($error,$student_qualification[$i]->$criteria_fieldname.' Result candidate is not eligible,Eligible candidate must be'.$criteria_value);     
                                }else if(strtolower($criteria_fieldname) === 'percentage'){
                                    array_push($error,$student_qualification[$i]->$criteria_fieldname.' Percentage candidate is not eligible,Eligible candidate must be'.convertors::comparisonName($criteria_operator). ' '.$criteria_value);     
                                }
                                break;
                            }                        
            }
        } 
          
            }else if(strtolower($type)=='and'){
                $admin_criteri_count = count($array_criteria);
                $student_qualification = $student_data->qualification;
                
                for($i=0;$i<count($student_qualification);$i++)
                {  
                    for($j=0;$j<count($array_criteria);$j++){
                            
                            $criteria_fieldname = $array_criteria[$j]->fieldname;
                            $criteria_operator = $array_criteria[$j]->comparison;
                            $criteria_value = $array_criteria[$j]->value;
                           
                                if(self::num_cond(strtolower($student_qualification[$i]->$criteria_fieldname),$criteria_operator,strtolower($criteria_value)))
                                {                                    
                                    $count_success++; 
                                     
                                    if($admin_criteri_count == $count_success){
                                        break 2;
                                    }                              
                                }else{
                                    $count_success= 0;
                                    if(strtolower($criteria_fieldname) === 'qualificationname'){
                                        array_push($error,$student_qualification[$i]->$criteria_fieldname.' qualified candidate is not eligible,Eligible candidate must be '.$criteria_value);     
                                    }else if(strtolower($criteria_fieldname) === 'university'){
                                        array_push($error,$student_qualification[$i]->$criteria_fieldname.' University candidate is not eligible,Eligible candidate must be from'.$criteria_value);     
                                    }else if(strtolower($criteria_fieldname) === 'typeresult'){
                                        array_push($error,$student_qualification[$i]->$criteria_fieldname.' Result candidate is not eligible,Eligible candidate must be'.$criteria_value);     
                                    }else if(strtolower($criteria_fieldname) === 'percentage'){
                                        array_push($error,$student_qualification[$i]->$criteria_fieldname.' Percentage candidate is not eligible,Eligible candidate must be'.convertors::comparisonName($criteria_operator). ' '.$criteria_value);     
                                    }
                                    break;
                                }                        
                }
            }            
            }            
        array_push(
            $response,[
                'result' => $admin_criteri_count,
                'success' => $count_success,
                'error' => $error
                ]
            );          
            return $response;        

    }
    
    public function getStudentExp($student_data){
        $result = array();

        $array_student = (array)$student_data->experience;   
      
        //  calculate student experience data 
        $last = 0;
        $z = 1;
        $lastdesignation = null;
        $designation = [];
        $array_date = [];
        $result = [];

        for($x=0;$x<count($array_student);$x++){  
            if($last >= 1){          
                $lastdesignation = $array_student[$x-$z]->designation;                
            }
            $currentdesignation = $array_student[$x]->designation;

            if($currentdesignation==$lastdesignation){              

               if(isset($result) && key_exists($currentdesignation,$result)){
                
                    $old_exp_date = $result[$currentdesignation];
                    
                    
                    $curr_startDate = new DateTime($array_student[$x]->fromDate);
                    $curr_endDate = new DateTime($array_student[$x]->toDate);
                    
                    $curr_difference = $curr_endDate->diff($curr_startDate);  
                    $curr_store_year     =   $curr_difference->format("%Y");
                    $curr_store_month    =   $curr_difference->format("%m");
                    $curr_store_day      =   $curr_difference->format("%d");
                    
            
                    $new_date = \Carbon\Carbon::createFromFormat("Y-m-d",$old_exp_date);
                    
                    $new_date->addYear($curr_store_year)->format("%Y");
                    $new_date->addMonth($curr_store_month)->format("%m");
                    $new_date->addDays($curr_store_day)->format("%d");                  
                  
                    $new_exp_date = $new_date->format("Y-m-d");
                    unset($result[$currentdesignation]);

                    array_push($designation,$currentdesignation);
                    array_push($array_date,$new_exp_date);
                   $result = array_combine($designation,$array_date);
                    
               }

            }elseif(isset($currentdesignation) && $lastdesignation==null){
         
                $startDate = new DateTime($array_student[$x]->fromDate);
                $endDate = new DateTime($array_student[$x]->toDate);            
                $difference = $endDate->diff($startDate);                

                $store_exp = $difference->format("%Y-%M-%d");
            
                array_push($designation,$currentdesignation);
                array_push($array_date,$store_exp);
               $result = array_combine($designation,$array_date);

            }else{
                             
                $startDate = new DateTime($array_student[$x]->fromDate);
                $endDate = new DateTime($array_student[$x]->toDate);
            
                $difference = $endDate->diff($startDate);                

                $store_exp = $difference->format("%Y-%M-%d");
          
                array_push($designation,$currentdesignation);
                array_push($array_date,$store_exp);
               $result = array_combine($designation,$array_date);

            }   
            $last++;
        }
 
            
        return $result;        
    }

    public function getAdminExp($criteria,$child){

        $temp_key = array();
        $temp_value = array();
        $response = array();
        $result = array();

        $admin_criteria = json_decode($criteria);        
        
        $child_personal = $child['personal_type']; //student personal 
        $child_type = $child['type'];                       // student type
        $child_criteria = json_decode($child['criteria']);  //student array data
        
        for($i=0;$i<count($admin_criteria);$i++){
            // array_push($response,['type'=>$child_type]);
           
            switch ($child_personal) {
                case 'Experience':            
                    for($j=0;$j<count($child_criteria);$j++){
                    
                        array_push($temp_key,'fieldname','comparison','value');                                
                        array_push($temp_value,$admin_criteria[$i]->value,$child_criteria[$j]->comparison,$child_criteria[$j]->value);  
                        $result = array_combine($temp_key,$temp_value);
                                                                             
                        array_push($response,$result);                                                      
                    }
                  break;          
                default:
                    for($j=0;$j<count($child_criteria);$j++){
                        
                        array_push($temp_key,$admin_criteria[$i]->value);                                
                        array_push($temp_value,$child_criteria[$j]->value);  
                        $result = array_combine($temp_key,$temp_value);
                                                                            
                        array_push($response,$result);                                                      
                    }
              }     
        }  
        
        return $response;   
    }

    public function matchexperiencejob($result_admin,$result_student,$type)
    {
        $response = array();
        $error = array();
    
            $child_type = $type;
            $count_success = 0;
            if(strtolower($child_type)=='or')
            {
                    $count_result_admin = 1;
                    for($i=0;$i<count($result_admin);$i++)
                    {                    
                            if(array_key_exists($result_admin[$i]['fieldname'],$result_student) && ($result_admin[$i]['fieldname'] == array_search($result_student[$result_admin[$i]['fieldname']],$result_student)))
                            {
                                $mydate = DATE('Y-m-d',strtotime($result_student[$result_admin[$i]['fieldname']]));
                                $year = (int)date("y",strtotime($mydate));
                                $month = (int)date("m",strtotime($mydate));

                                $student_exp =  (int)$year.'.'.$month;
                                $comparor = $result_admin[$i]['comparison'];  
                             
                                 
                            if(self::num_cond($student_exp,$comparor,$result_admin[$i]['value']))
                            {                                    
                                $count_success++;   
                            }                          
                            }else{
                                array_push($error,'candidate have experience in '.array_search($result_student[$result_admin[$i]['fieldname']],$result_student));     
                            }                        
                    }
                    array_push($response,['success'=>$count_success,'error'=>$error,'result'=>$count_result_admin]);                     
            }elseif(strtolower($child_type)=='and')
            {                    
                    $count_result_admin = count($result_admin);
                    for($i=0;$i<count($result_admin);$i++)
                    {
                            if(array_key_exists($result_admin[$i]['fieldname'],$result_student) && ($result_admin[$i]['fieldname'] == array_search($result_student[$result_admin[$i]['fieldname']],$result_student)))
                            {
                                                            
                               $mydate = DATE('Y-m-d',strtotime($result_student[$result_admin[$i]['fieldname']]));
                               $year = (int)date("y",strtotime($mydate));
                               $month = (int)date("m",strtotime($mydate));

                                $student_exp =  (int)$year.'.'.$month;                               
                                $comparor = $result_admin[$i]['comparison'];                                 
                          
                                    if(self::num_cond($student_exp,$comparor,$result_admin[$i]['value']))
                                    // self::num_cond($result_admin[$i]['value'],$comparor,$student_exp)
                                    {                                    
                                        $count_success++;   
                                    }                          
                            }else{
                                array_push($error,'candidate have experience in '.array_search($result_student[$result_admin[$i]['fieldname']],$result_student));  
                            }                        
                    }
                    array_push($response,['success'=>$count_success,'error'=>$error,'result'=>$count_result_admin]);
            }
            
               return $response;
    }

    function num_cond ($var1, $op, $var2) {         // student exp '=,!=,>=,<=,>,<' 'admin exp required'  '1.2 >= 2'

        switch ($op) {
            case "=":  return $var1 == $var2;
            case "!=": return $var1 != $var2;
            case ">=": return $var1 >= $var2;
            case "<=": return $var1 <= $var2;
            case ">":  return $var1 >  $var2;
            case "<":  return $var1 <  $var2;
        default:       return false;
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
        if($exists){
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
        }else{
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

    public function testFunction()
    {
    
        $job = Transaction::where('order_id','22111906353812')->select('job_id')->first();
        $data = json_decode($job->job_id);
        var_dump($data);
        foreach($data as $value){           
                 AppliedJobByUser::where('user_id',12)
                        ->where('job_id',$value)
                        ->update([                                
                            'payment_status'=>'success',                                
                            'updated_at'=>Carbon::now()
                        ]);
        }


    }
}
