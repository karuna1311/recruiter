<?php

namespace App\Http\Controllers\User;

use DateTime;
use Carbon\Carbon;
use App\Models\Jobs;
use App\Models\User;
use App\Models\UserReservation;
use App\Traits\convertors;
use Illuminate\Http\Request;
use App\Models\UserExperience;
use App\Models\AppliedJobByUser;
use App\Models\UserQualification;
use App\Models\EligibleCandidates;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AppliedJobByUserExperience;
use App\Models\AppliedJobByUserQualification;

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
        // abort_if(Gate::denies('postavailable'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
 
        $jobs = Jobs::all();
        return view('user.ApplicationForm.PostAvailable',compact('jobs'));
    }

    public function checkJobAvailability($enc_id)
    {        
        $user_id = $this->getUserID();       
        // get user data 
        $studentdata = UserReservation::with(['qualification','experience'])        
        ->where('user_reservation.user_id',$user_id)
        ->first();
       
        $student_json = json_decode($studentdata);
 
        // dd($student_json);
        $instructionArray=json_decode(Storage::disk('uploads')->get('Instructions/json/admin_job.json'),true);
        
        $instruction_json = $instructionArray;
        // dd($instruction_json);
        
        // personal_reservation
        $per_res_success = [];
        $per_res_success_count = 0;
        $per_res_error = [];
        $per_res_error_count = 0;

        // reservation
        $res_success = [];
        $res_success_count = 0;
        $res_error = [];
        $res_error_count = 0;
        // qualification
        $qual_success = [];
        $qual_success_count = 0;
        $qual_error = [];
        $qual_error_count = 0;
        // experience
        $exp_success = [];
        $exp_success_count = 0;
        $exp_error = [];
        $exp_error_count = 0;
        
        $temp_errors = [];
        $result = array();

        $job_id_exists = [];
      $job_id = base64_decode($enc_id);  
    //   dd($job_id);
        foreach($instructionArray as $value)
        {
            array_push($job_id_exists,$value['job_id']);
          
            if($value['job_id']==$job_id) 
            {
                
                switch (strtolower($value['personal_type'])) 
                {

                    case 'personal_reservation':
                    
                        $response = self::match_personal_reservation($value['criteria'],$student_json,$value['type']); 
                    //    dd($response); 
                        if(strtolower($value['type'])=='or'){
                            if($response[0]['per_res_success']>=$response[0]['admin_criteria_count']){
                                array_push($per_res_success,['success'=>'candidate is eligible in Personal details with reservation section']);
                                $per_res_success_count++;
                            }else{
                                array_push($per_res_error,['error'=>$response[0]['per_res_error_msg']]);
                                $per_res_error_count++;
                            }
                        }else if(strtolower($value['type'])=='and'){
                            if($response[0]['per_res_success']==$response[0]['admin_criteria_count']){
                                array_push($per_res_success,['success'=>'candidate is eligible in Personal details with reservation section']);
                                $per_res_success_count++;
                            }else{
                                array_push($per_res_error,['error'=>$response[0]['per_res_error_msg']]);
                                $per_res_error_count++;
                            }
                        }


                    break;
                    case 'reservation':
                    
                        $response = self::matchjob($value['criteria'],$student_json,$value['type']); 
                        
                            if(strtolower($value['type'])=='or'){
                                if($response[0]['res_success']>=$response[0]['admin_criteria_count']){
                                    array_push($res_success,['success'=>'candidate is eligible in reservation section']);
                                    $res_success_count++;
                                }else{
                                    array_push($res_error,['error'=>$response[0]['res_error']]);
                                    $res_error_count++;
                                }
                            }else if(strtolower($value['type'])=='and'){
                                if($response[0]['res_success']==$response[0]['admin_criteria_count']){
                                    array_push($res_success,['success'=>'candidate is eligible in reservation section']);
                                    $res_success_count++;
                                }else{
                                    array_push($res_error,['error'=>$response[0]['res_error']]);
                                    $res_error_count++;
                                }
                            }              
                    break;
                    
                    case 'qualification':                   
                    
                        $response = self::matchqualificationjob($value['criteria'],$student_json,$value['type']); 
                            // dd($response);
                            if(strtolower($value['type'])=='or'){
                                if($response[0]['result']>=$response[0]['success']){
                                    array_push($qual_success,['success'=>'candidate is eligible with the qualification']);  
                                    $qual_success_count++;
                                }else{
                                    if($value['description']!=null){
                                        array_push($qual_error,['error'=>$value['description']]);         //error msg display from admin
                                        $qual_error_count++;
                                    }else{
                                        array_push($qual_error,['error'=>$response[0]['error']]);
                                        $qual_error_count++;
                                    }
                                }
                            }else if(strtolower($value['type'])=='and'){
                                
                                if($response[0]['result']==$response[0]['success']){
                                    array_push($qual_success,['success'=>'candidate is eligible with the qualification']);  
                                    $qual_success_count++;                       
                                }else{                               
                                    if($value['description']!=null){
                                        array_push($qual_error,['error'=>$value['description']]);         //error msg display from admin
                                        $qual_error_count++;
                                    }else{
                                        array_push($qual_error,['error'=>$response[0]['error']]); 
                                        $qual_error_count++;
                                    }
                                }                          
                            }                     
                            break;                       
                    case 'experience':                    
                    
                    $result_student_exp = self::getStudentExp($student_json);
                    $result_admin_exp = self::getAdminExp($value['criteria'],$value['children'][0]);
                    $response = self::matchexperiencejob($result_admin_exp,$result_student_exp,$value['children'][0]['type']); 
                    

                    if(strtolower($value['type'])=='or'){
                        if($response[0]['result']>=$response[0]['success']){
                            array_push($exp_success,['success'=>'candidate is eligible with the experience']);  
                            $exp_success_count++;
                        }else{
                            if($value['description']!=null){
                                array_push($exp_error,['error'=>$value['description']]);         //error msg display from admin
                                $exp_error_count++;
                            }else{
                                array_push($exp_error,['error'=>$response[0]['error']]);
                                $exp_error_count++;
                            }
                        }
                    }else if(strtolower($value['type'])=='and'){
                        
                        if($response[0]['result']==$response[0]['success']){
                            array_push($exp_success,['success'=>'candidate is eligible with the experience']);  
                            $exp_success_count++;                       
                        }else{                               
                            if($value['description']!=null){
                                array_push($exp_error,['error'=>$value['description']]);         //error msg display from admin
                                $exp_error_count++;
                            }else{
                                array_push($exp_error,['error'=>$response[0]['error']]); 
                                $exp_error_count++;
                            }
                        }                          
                    } 
                        break;   
                        
                    }  

            }
            // else{
                
        
                    
                           
            // }      
               
            $checkCandidate =  EligibleCandidates::where('user_id', '=',$user_id)
                                    ->where('job_id', '=',$job_id)
                                    ->exists();

              
                                    // dd($job_id_exists);
            if($res_error_count== 0 && $qual_error_count==0 && $exp_error_count==0 && $per_res_error_count == 0 && in_array($job_id,$job_id_exists))
            {

                    if($checkCandidate){
                    $store =   EligibleCandidates::where('user_id', '=',$user_id)
                                        ->where('job_id', '=',$job_id)
                                        ->update(['status' => 1]);
                    }else{
                        $store =   EligibleCandidates::insert([
                            'user_id' => $user_id,
                            'job_id' => $job_id,
                            'status' => 1
                        ]);                                   
                    }             

                    if ($store) {
                        return response()->Json([
                            'res_success' => $res_success,
                            'per_res_success' => $per_res_success,
                            'qual_success' => $qual_success,
                            'exp_success' => $exp_success,
                            'success' => 1,
                            'error' => 0,
                        ]);
                    }
            }else if(!in_array($job_id,$job_id_exists)){
                        $no_criteria = 'No Criteria Made by Admin';
                        return response()->Json([                    
                            'zero_criteria' => $no_criteria,                 
                            'error'     => 1
                            ]);
            }else{     

                    if($checkCandidate)
                    {
                    $store =   EligibleCandidates::where('user_id', '=',$user_id)
                                        ->where('job_id', '=',$job_id)
                                        ->update(['status' => 0]);
                    }else
                    {
                    $store =  EligibleCandidates::insert([
                            'user_id' => $user_id,
                            'job_id' => $job_id,
                            'status' => 0
                        ]);                                   
                    } 

                return response()->Json([
                                        'res_error' => $res_error,
                                        'per_res_error' => $per_res_error,
                                        'qual_error' => $qual_error,
                                        'exp_error' => $exp_error,                                           
                                        'res_success' => $res_success,
                                        'per_res_success' => $per_res_success,
                                        'qual_success' => $qual_success,
                                        'exp_success' => $exp_success,
                                        'success' => 0,
                                        'error'     => 1
                                        ]);
            } 
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
                            // self::num_cond(strtolower($array_student[$fieldname]),$comparison,$value)
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
                    // self::num_cond(strtolower($array_student[$fieldname]),$comparison,$value)
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
        
        // $array_student = (array)$student_data->qualification;   

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

    public function applyJob($id){
        $job_id = base64_decode($id);
        $user_id = $this->getUserID();
        

        $exists = EligibleCandidates::where('user_id', '=',$user_id)
                                    ->where('job_id', '=',$job_id)
                                    ->where('status','=', 1)
                                    ->exists();

        if($exists){
            //true means candidate is eligible with job
            $basic_user_data = UserReservation::Select('*')->where('user_id',$user_id)->first();
            $qual_user_data = UserQualification::Select('*')->where('user_id',$user_id)->get();
            $exp_user_data = UserExperience::Select('*')->where('user_id',$user_id)->get();

            $json_basic_user = json_encode($basic_user_data);
            $json_qual_user = json_encode($qual_user_data);
            $json_exp_user = json_encode($exp_user_data);

           $user_data = AppliedJobByUser::Insert([
                                'user_id' => $user_id,
                                'job_id' => $job_id,
                                'json' => $json_basic_user,
                                ]);

           $user_qualification_data = AppliedJobByUserQualification::Insert([
                                            'user_id' => $user_id,
                                            'job_id' => $job_id,
                                            'json' => $json_qual_user,
                                            ]);

                
           $user_experience_data =  AppliedJobByUserExperience::Insert([
                                            'user_id' => $user_id,
                                            'job_id' => $job_id,
                                            'json' => $json_exp_user,
                                            ]);

            if($user_data == true && ($user_qualification_data == true || $user_experience_data ==true ))
            {
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
}
