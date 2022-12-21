<?php

namespace App\Services;
use Auth;
use App\Models\UserReservation;
use Carbon\Carbon;
use Storage;
use App\Services\ScheduleMasterService;
class JobApplicationService 
{
    public static function checkEligibity($studentData,$jobId)
    {
        $applicableCheck=self::checkApplicableCriteria($jobId,$studentData);
  
        if(count($applicableCheck) && $applicableCheck['status']!='success') return $applicableCheck;
        return ['status'=>'success'];
           
    }
    public static function checkApplicableCriteria($jobId,$masterData)
    {
        if(!Storage::disk('json')->exists('criteria/json/'.$jobId.'.json')) return ['status'=>'error','data'=>'Session criteria file not found'];

        $conditionArray=json_decode(Storage::disk('json')->get('criteria/json/'.$jobId.'.json'),true);


        $result = 0;
        $resultres = 0;
        $resultqual = 0;
        $resultexp = 0;
        $resultexp_qual = 0;
        $arryOfReservationErr=array();
        $arryOfConditionErr=array();
    
        foreach($conditionArray as $condition){
            $Total_count = $condition['TotalCount'];

         
            if($condition['conditionType'] === 'reservation'){
            foreach ($condition['conditionCriteria'] as $key => $conditionCriteria) {
            
                    if($conditionCriteria['type']== 'Field'){
                        $success = $conditionCriteria['successvalue'];
                         $returnvaluereserv=self::isEligible($conditionCriteria,$masterData);
                  
                        if($returnvaluereserv == $success){                             
                                $resultres = $resultres + 1;
                            }else{
                                array_push($arryOfReservationErr, $condition['conditionError']);                                
                            }

                    }else if($conditionCriteria['type']== 'Or'){                     
                       $success = $conditionCriteria['successvalue'];
                     
                            $returnvaluereserv=self::isEligibleOrWithAnd($conditionCriteria['children'],$masterData);
                         
                            if($returnvaluereserv >= $success){                             
                                $resultres = $resultres + 1;
                            }else{
                                array_push($arryOfReservationErr, $condition['conditionError']);                                
                            }
                            
                    }
                }
             
             }
             else if($condition['conditionType'] === 'qualification')
             {
                $success = $conditionCriteria['successvalue'];
       
                foreach ($condition['conditionCriteria'] as $key => $conditionCriteria) {
                         $returnvaluequal=self::isEligible($conditionCriteria,$masterData['qualification']);                
                    }
                  
                    if(self::comparissionGreaterThanEqualsTo(intval($returnvaluequal),intval($success))){                                
                            $resultqual = $resultqual + 1;
                    }
                    else{
                          $arryOfConditionErr[]=$condition['conditionError'];
                    }                  
             }
               else if($condition['conditionType'] === 'experience')
             {
                $success = $conditionCriteria['successvalue'];
       
                foreach ($condition['conditionCriteria'] as $key => $conditionCriteria) {                           
                         $returnvalueexp=self::isEligible($conditionCriteria,$masterData['0']['experience']);                
                    }
                  
                    if(self::comparissionGreaterThanEqualsTo(intval($returnvalueexp),intval($success))){                                
                            $resultexp = $resultexp + 1;
                    }
                    else{        
                       
                          $arryOfConditionErr[]=$condition['conditionError'];
                    }                  
             }
        }

       $result = $resultres + $resultqual + $resultexp;
       
    // echo $resultres. '+'. $resultqual .'+'. $resultexp;
       if(($resultqual >= 1 && $resultexp >= 1) || (($jobId == 7 || $jobId == 8 || $jobId == 9)&& $resultqual == 0))
       {
        
                if($jobId == 1)
                {
                        $desgination_criteria = array( array("381"=>"3"),array("379"=>"3"),array("1507"=>"3"),array("1507"=>"5"));                      
                        $experience = $masterData['0']['experience'];
                        $qualification = $masterData['qualification'];

                        foreach($desgination_criteria as $value1){
                            foreach($value1 as $key=>$value){
                            
                            for($i=0;$i<count($experience);$i++)
                            {                               
                             
                                if($key== $experience[$i]['postNameLookupId'] && self::comparissionGreaterThanEqualsTo($experience[$i]['total_exp_year'],$value))
                                {

                                     if($key==1507 && self::comparissionGreaterThanEqualsTo($value,5))
                                     {

                                        $qualification_criteria = array("M. Com."=>"PASSED", "M.A."=>"481", "M.B.A."=>"1162");
                                            foreach($qualification_criteria as $key=>$value){

                                                    if($key == 'M. Com.'){
                                                           for($j=0;$j<count($qualification);$j++){ 
                                                                if($key== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['typeResult'],$value))
                                                                {
                                                                    $resultexp_qual = $resultexp_qual + 1;
                                                                }
                                                           }

                                                    }else{
                                                        for($j=0;$j<count($qualification);$j++){ 
                                                                if($key== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['subject'],$value))
                                                                {
                                                                    $resultexp_qual = $resultexp_qual + 1;
                                                                }
                                                           
                                                           }
                                                    }

                                            }    
                                            
                                            if( $resultexp_qual == 0 && $key==1507 && self::comparissionGreaterThanEqualsTo($value,3))
                                            {
                                                    $qualification_criteria = array("ICWA"=>"PASSED", "CA"=>"PASSED", "CS"=>"PASSED");
                                                    // dd($qualification);
                                                    foreach($qualification_criteria as $key=>$value){
                                                                for($j=0;$j<count($qualification);$j++){ 
                                                                        if($key== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['typeResult'],$value))
                                                                        {
                                                                        $resultexp_qual = $resultexp_qual + 1; 
                                                                        }
                                                                }                                                  
                                                        }

                                                        if($resultexp_qual == 0){
                                                            $condition['conditionError'] = 'Experience with Qualification failed';                    
                                                            array_push($arryOfConditionErr, $condition['conditionError']);             
                                                        }  

                                            }
                                
                                     }
                                     else if($key==1507 && self::comparissionGreaterThanEqualsTo($value,3)){


                                        $qualification_criteria = array("ICWA"=>"PASSED", "CA"=>"PASSED", "CS"=>"PASSED");
                                            // dd($qualification);
                                            foreach($qualification_criteria as $key=>$value){
                                                           for($j=0;$j<count($qualification);$j++){ 
                                                                if($key== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['typeResult'],$value))
                                                                {
                                                                   $resultexp_qual = $resultexp_qual + 1; 
                                                                }
                                                           }                                                  
                                                }


                                     }
                                     else if($key==381 && self::comparissionGreaterThanEqualsTo($value,3)){
                                  
                                            $qualification_criteria = array("ICWA"=>"PASSED", "CA"=>"PASSED", "CS"=>"PASSED");

                                            foreach($qualification_criteria as $key=>$value){
                                                           for($j=0;$j<count($qualification);$j++){ 
                                                                if($key== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['typeResult'],$value))
                                                                {
                                                                   $resultexp_qual = $resultexp_qual + 1; 
                                                                }
                                                           }                                                  
                                                }
                                            // echo 'here'.$resultexp_qual;
                                     }else if($key==379 && self::comparissionGreaterThanEqualsTo($value,3)){

                                            $qualification_criteria = array("ICWA"=>"PASSED", "CA"=>"PASSED", "CS"=>"PASSED");

                                            foreach($qualification_criteria as $key=>$value){
                                                           for($j=0;$j<count($qualification);$j++){ 
                                                                if($key== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['typeResult'],$value))
                                                                {
                                                                    $resultexp_qual = $resultexp_qual + 1;
                                                                }
                                                           }                                                  
                                                }
                                    }
                                }
                                                      
                            }
                        } 
                    } 
                   
                        if($resultexp_qual == 0){
                            $condition['conditionError'] = 'Experience with Qualification failed';                    
                            array_push($arryOfConditionErr, $condition['conditionError']);             
                        }  
                }else if($jobId == 4)
                {
                    $desgination_criteria = array(array("1508"=>"1"), array("1508"=>"2"));
                    
                    $experience = $masterData['0']['experience'];
                        $qualification = $masterData['qualification'];

                    foreach($desgination_criteria as $value1)
                    {
                        foreach($value1 as $key=>$value){
                            for($i=0;$i<count($experience);$i++){    
                             
                                if($key== $experience[$i]['postNameLookupId'] && self::comparissionGreaterThanEqualsTo($experience[$i]['total_exp_year'],$value))
                                {

                                     if($key==1508 && $value >= 1){

                                        $qualification_criteria = array("ICWA"=>"PASSED","CA"=>"PASSED","CS"=>"PASSED");

                                            foreach($qualification_criteria as $keyy=>$valuee){
                                               for($j=0;$j<count($qualification);$j++){ 
                                                    if($keyy== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['typeResult'],$valuee))
                                                    {
                                                        $resultexp_qual = $resultexp_qual + 1;
                                                    }                                                 
                                               }                                              
                                            }
                                        }
                                            

                                        if($resultexp_qual == 0 && $key== 1508 && $value >= 2){
                                            
                                                $qualification_criteria = array(array('B.Com' => '2906'),array('B.Com' => '2907'),array('B.Com' => '2908'),
                                                array('M. Com.' => '2912'),array('M. Com.' => '684'),array('M. Com.' => '686'),
                                                array('M.B.A.' => '1164'),array('M.B.A.' => '1163'),array('M.B.A.' => '1162'),
                                                );
                                            
                                                foreach($qualification_criteria as $value1){
                                                    foreach($value1 as $key=>$value){
                                                        for($j=0;$j<count($qualification);$j++)
                                                            { 
                                                            
                                                                if($key== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['subject'],$value))
                                                                {
                                                                $resultexp_qual = $resultexp_qual + 1; 
                                                                }                                                             
                                                
                                                            }                                                  
                                                        }
                                                }
                                            
                                            }
    
                                            // if($resultexp_qual == 0)
                                            // {
                                            //     $condition['conditionError'] = 'Experience with Qualification failed';                    
                                            //     array_push($arryOfConditionErr, $condition['conditionError']);             
                                            // } 

                                     }else if($key==1508 && $value >= 2){


                                    $qualification_criteria = array(array('B.Com' => '2906'),array('B.Com' => '2907'),array('B.Com' => '2908'),
                                                                    array('M. Com.' => '2912'),array('M. Com.' => '684'),array('M. Com.' => '686'),
                                                                    array('M.B.A.' => '1164'),array('M.B.A.' => '1163'),array('M.B.A.' => '1162'),
                                                                    );
                                            // dd($qualification);
                                            foreach($qualification_criteria as $value1){
                                                foreach($value1 as $keyy=>$valuee){
                                                   for($j=0;$j<count($qualification);$j++)
                                                   { 
                                               
                                                        if($keyy== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['subject'],$valuee))
                                                        {
                                                           $resultexp_qual = $resultexp_qual + 1; 
                                                        }
                                                    
                                                   }                                                  
                                                }
                                            }  
                                                                                 
                                        }

                                }                        
                            }
                    }     
                    if($resultexp_qual == 0)
                    {
                        $condition['conditionError'] = 'Experience with Qualification failed';                    
                        array_push($arryOfConditionErr, $condition['conditionError']);             
                    }              
                
                }else if($jobId == 7)
                {                       
                        if($resultexp >= 1)
                        {
                                $desgination_criteria = array("384"=>"2");

                                $experience = $masterData['0']['experience'];
                                    $qualification = $masterData['qualification'];
            
                                    foreach($desgination_criteria as $key=>$value){
                            
                                        for($i=0;$i<count($experience);$i++){                               
                                            if($key== $experience[$i]['postNameLookupId'] && self::comparissionGreaterThanEqualsTo($experience[$i]['total_exp_year'],$value)){
                                                if($key==384 && $value == 2){
            
            
                                                    $qualification_criteria = array(array('B.Com' => '2906'),array('B.Com' => '2907'),array('B.Com' => '2908'),
                                                    array('M. Com.' => '2912'),array('M. Com.' => '684'),array('M. Com.' => '686'),
                                                    array('M.B.A.' => '1164'),array('M.B.A.' => '1163'),array('M.B.A.' => '1162'),
                                                    );
                                                        // dd($qualification);
                                                        foreach($qualification_criteria as $value1){
                                                            foreach($value1 as $key=>$value){
                                                                for($j=0;$j<count($qualification);$j++)
                                                                { 
                                                                    // echo $key.'-'.$value;
                                                                        if($key== $qualification[$j]['qualificationname'] && self::comparissionEquals($qualification[$j]['subject'],$value))
                                                                        {
                                                                        $resultexp_qual = $resultexp_qual + 1; 
                                                                        }
                                                                }                                                  
                                                            }
                                                        }
                                                }
                                            }                       
                                    }
                            
                            }
                            if($resultexp_qual == 0){
                                $condition['conditionError'] = 'Experience with Qualification failed';                    
                                array_push($arryOfConditionErr, $condition['conditionError']);             
                            }  
                        }else if($resultexp == 0)
                        {
                                // fresher candidate with qualification : ICWA OR CA OR CS                   
                                $qualification = $masterData['qualification'];
                                        
                                $qualification_criteria = array("ICWA"=>"PASSED","CA"=>"PASSED","CS"=>"PASSED");

                                foreach($qualification_criteria as $key=>$value){               
                                        for($j=0;$j<count($qualification);$j++)
                                        { 
                                        
                                                if(self::comparissionEquals($qualification[$j]['qualificationname'],$key) && self::comparissionEquals($qualification[$j]['typeResult'],$value))
                                                {
                                                    $resultexp_qual = $resultexp_qual + 1; 
                                                }
                                        }                                                  
                                } 

                                $arryOfConditionErr = array();
                                if($resultexp_qual == 0){

                                    $condition['conditionError'] = 'Fresher Don`t have required Qualification';                    
                                    array_push($arryOfConditionErr, $condition['conditionError']);             
                                } 
                        }       
        
                }    
                else if($jobId == 8)
                {
                
                
                                if(($resultqual == 0 && $resultexp >= 1) || ($resultqual >= 1 && $resultexp >= 1))
                                {
                                    $arryOfConditionErr = array();
                                    $jobnature_criteria = array(array("1510"=>"3"), array("1511"=>"3"),array("1512" => "3"),array("1510"=>"5"),array("1511"=>"5"),array("1512" => "5"));
                                    
                                    $experience = $masterData['0']['experience'];
                                    $qualification = $masterData['qualification'];
                                    // dd($qualification);
                                    foreach($jobnature_criteria as $value1)
                                    {
                                        foreach($value1 as $key=>$value)
                                        {
                                            for($i=0;$i<count($experience);$i++)
                                            {                               
                                                // echo $key.'-'.$value;
                                                // echo "<br>";
                                                if($key== $experience[$i]['jobNatureLookupId'] && self::comparissionGreaterThanEqualsTo($experience[$i]['total_exp_year'],$value))
                                                {                                        
                                                if($key==1510 && self::comparissionGreaterThanEqualsTo(3,$value))
                                                {
                                                    
                                                    $qualification_criteria = array(array("B.E."=>"36"),array("B.E."=>"1872"));

                                                        foreach($qualification_criteria as $value1){
                                                            foreach($value1 as $keyy=>$valuee){
                                                                for($j=0;$j<count($qualification);$j++){ 
                                                                    if(self::comparissionEquals($qualification[$j]['qualificationname'],$keyy) && self::comparissionEquals($qualification[$j]['subject'],$valuee))
                                                                    {
                                                                        $resultexp_qual = $resultexp_qual + 1;
                                                                    }
                                                                }                                              
                                                            }
                                                        }
                                                        
                                                        
                                                        if($resultexp_qual == 0 && $key==1510  && self::comparissionGreaterThanEqualsTo(5,$value))
                                                        {
                                                                $qualification_criteria = array("B.C.A."=>"DCA","M.C.A."=>"DCA");
                                                    
                                                                $candidate_qualifcation_name = array();
                                                                
                                                                for($j=0;$j<count($qualification);$j++){ 
                                                                            array_push($candidate_qualifcation_name,$qualification[$j]['qualificationname']);                                               
                                                                }     
                                                                
                                                                foreach($qualification_criteria as $qual_key=>$qual_value){
                                                                    if(in_array($qual_key,$candidate_qualifcation_name) && in_array($qual_value,$candidate_qualifcation_name)){
                                                                            $resultexp_qual = $resultexp_qual + 1;
                                                                        }
                                                                }

                                                                if($resultexp_qual == 0){
                                                                    $condition['conditionError'] = 'Candidate must be qualify with Two Degree';                    
                                                                    array_push($arryOfConditionErr, $condition['conditionError']);             
                                                                }
                                                        }

                                                        if($resultexp_qual == 0){
                                                            $condition['conditionError'] = 'Experience with Qualification failed';                    
                                                            array_push($arryOfConditionErr, $condition['conditionError']);             
                                                        }

                                                }else if($key==1511 && self::comparissionGreaterThanEqualsTo(3,$value)){

                                                    $qualification_criteria = array(array("B.E."=>"36"),array("B.E."=>"1872"));

                                                        foreach($qualification_criteria as $value1){
                                                            foreach($value1 as $qualkey=>$qualvalue){
                                                                for($j=0;$j<count($qualification);$j++){ 
                                                                        if(self::comparissionEquals($qualification[$j]['qualificationname'],$qualkey) && self::comparissionEquals($qualification[$j]['subject'],$qualvalue))
                                                                        {
                                                                            $resultexp_qual = $resultexp_qual + 1;
                                                                        }
                                                                }                                              
                                                            }
                                                        }

                                                        if($resultexp_qual == 0 && $key==1511  && self::comparissionGreaterThanEqualsTo(5,$value)){
                                                            $qualification_criteria = array("B.C.A."=>"DCA","M.C.A."=>"DCA");
                                                
                                                            $candidate_qualifcation_name = array();
                                                            
                                                            for($j=0;$j<count($qualification);$j++){ 
                                                                        array_push($candidate_qualifcation_name,$qualification[$j]['qualificationname']);                                               
                                                            }     
                                                            
                                                            foreach($qualification_criteria as $qualkey=>$qualvalue){
                                                                if(in_array($qualkey,$candidate_qualifcation_name) && in_array($qualvalue,$candidate_qualifcation_name)){
                                                                        $resultexp_qual = $resultexp_qual + 1;
                                                                    }
                                                            }

                                                            if($resultexp_qual == 0){
                                                                $condition['conditionError'] = 'Candidate must be qualify with Two Degree';                    
                                                                array_push($arryOfConditionErr, $condition['conditionError']);             
                                                            }
                                                    }

                                                    if($resultexp_qual == 0){
                                                        $condition['conditionError'] = 'Experience with Qualification failed';                    
                                                        array_push($arryOfConditionErr, $condition['conditionError']);             
                                                    }      
                                        
                                                }else if($key==1512 && self::comparissionGreaterThanEqualsTo(3,$value)){
                                                        
                                                    $qualification_criteria = array(array("B.E."=>"36"),array("B.E."=>"1872"));

                                                        foreach($qualification_criteria as $value1){
                                                            foreach($value1 as $qualkey=>$qualvalue){
                                                                for($j=0;$j<count($qualification);$j++){ 
                                                                    // echo $key.'='.$qualification[$j]['qualificationname'];
                                                                    // echo $value.'='.$qualification[$j]['subject'];
                                                                    // echo "<br>";
                                                                        if(self::comparissionEquals($qualification[$j]['qualificationname'],$qualkey) && self::comparissionEquals($qualification[$j]['subject'],$qualvalue))
                                                                        {
                                                                            $resultexp_qual = $resultexp_qual + 1;
                                                                        }
                                                                }                                              
                                                            }
                                                        }
                                                        // echo "<br>";
                                                        // echo $resultexp_qual;
                                                        // echo "<br>";
                                                        if($resultexp_qual == 0){
                                                            $condition['conditionError'] = 'Experience with Qualification failed';                    
                                                            array_push($arryOfConditionErr, $condition['conditionError']);             
                                                        }  

                                                        if($resultexp_qual == 0 && $key==1512  && self::comparissionGreaterThanEqualsTo(5,$value)){
                                                            $qualification_criteria = array("B.C.A."=>"DCA","M.C.A."=>"DCA");
                                                
                                                            $candidate_qualifcation_name = array();
                                                            
                                                            for($j=0;$j<count($qualification);$j++){ 
                                                                        array_push($candidate_qualifcation_name,$qualification[$j]['qualificationname']);                                               
                                                            }     
                                                            
                                                            foreach($qualification_criteria as $qualkey=>$qualvalue){
                                                                if(in_array($qualkey,$candidate_qualifcation_name) && in_array($qualvalue,$candidate_qualifcation_name)){
                                                                        $resultexp_qual = $resultexp_qual + 1;
                                                                    }
                                                            }

                                                            if($resultexp_qual == 0){
                                                                $condition['conditionError'] = 'Candidate must be qualify with Two Degree';                    
                                                                array_push($arryOfConditionErr, $condition['conditionError']);             
                                                            }
                                                    }

                                                    

                                                }
                                                else if($key==1510 && self::comparissionGreaterThanEqualsTo(5,$value)){
                                                    $qualification_criteria = array("B.C.A."=>"DCA","M.C.A."=>"DCA");
                                            
                                                        $candidate_qualifcation_name = array();
                                                        
                                                        for($j=0;$j<count($qualification);$j++){ 
                                                                    array_push($candidate_qualifcation_name,$qualification[$j]['qualificationname']);                                               
                                                        }     
                                                        
                                                        foreach($qualification_criteria as $qualkey=>$qualvalue){
                                                            if(in_array($qualkey,$candidate_qualifcation_name) && in_array($qualvalue,$candidate_qualifcation_name)){
                                                                    $resultexp_qual = $resultexp_qual + 1;
                                                                }
                                                        }

                                                        if($resultexp_qual == 0)
                                                        {
                                                                $condition['conditionError'] = 'Candidate must be qualify with Two Degree';                    
                                                                array_push($arryOfConditionErr, $condition['conditionError']);   
                                                                break;          
                                                            }       
                                                

                                                }else if($key==1511 && self::comparissionGreaterThanEqualsTo(5,$value)){
                                                    $qualification_criteria = array("B.C.A."=>"DCA","M.C.A."=>"DCA");
                                                    
                                                    $candidate_qualifcation_name = array();
                                                    
                                                    for($j=0;$j<count($qualification);$j++){ 
                                                        array_push($candidate_qualifcation_name,$qualification[$j]['qualificationname']);                                               
                                                                                                            
                                                    }     
                                                    
                                                    foreach($qualification_criteria as $qualkey=>$qualvalue){
                                                        if(in_array($qualkey,$candidate_qualifcation_name) && in_array($qualvalue,$candidate_qualifcation_name)){
                                                                $resultexp_qual = $resultexp_qual + 1;
                                                            }
                                                    }
                                                    if($resultexp_qual == 0)
                                                    {
                                                            $condition['conditionError'] = 'Candidate must be qualify with Two Degree';                    
                                                            array_push($arryOfConditionErr, $condition['conditionError']);  
                                                            break;  

                                                        }

                                                }else if($key==1512 && self::comparissionGreaterThanEqualsTo(5,$value)){
                                                    $qualification_criteria = array("B.C.A."=>"DCA","M.C.A."=>"DCA");
                                                    
                                                    $candidate_qualifcation_name = array();
                                                    
                                                    for($j=0;$j<count($qualification);$j++){                                                     
                                                                array_push($candidate_qualifcation_name,$qualification[$j]['qualificationname']);                                               
                                                    }     
                                                    
                                                    foreach($qualification_criteria as $qualkey=>$qualvalue){
                                                        if(in_array($qualkey,$candidate_qualifcation_name) && in_array($qualvalue,$candidate_qualifcation_name)){
                                                                $resultexp_qual = $resultexp_qual + 1;
                                                            }
                                                    }
                                                    if($resultexp_qual == 0)
                                                        {
                                                            $condition['conditionError'] = 'Candidate must be qualify with Two Degree';                    
                                                            array_push($arryOfConditionErr, $condition['conditionError']);
                                                            break;
                                                        }
                                                }                                     
                                                }                                                        
                                            }
                                        }
                                    }                     
                            }                            
                }
                else if($jobId == 9)
                {
                            // echo $resultres. '+' .$resultqual. '+' .$resultexp;
                                    //  $resultqual == 0 && $resultexp == 0

                                    $qualification = $masterData['qualification'];

                                    $candidate_qualifcation_name = array();
                                                    
                                    for($j=0;$j<count($qualification);$j++){                                                     
                                            array_push($candidate_qualifcation_name,$qualification[$j]['qualificationname']);                                               
                                    }

                                    $arryOfConditionErr = array();
                                    if($resultexp == 0)
                                    {
                                    $condition['conditionError'] = 'Experience Failed';                    
                                    array_push($arryOfConditionErr, $condition['conditionError']);   
                                    }else if($resultexp >= 1 && $resultqual == 0 || ($resultexp >= 1 && $resultqual >= 1))
                                    {                          
                                    // BE degree with subjects
                                    $qualification_criteria = array(array("B.E."=>"36"),array("B.E."=>"1872"));
                                    
                                    

                                    foreach($qualification_criteria as $value1){
                                        foreach($value1 as $key=>$value){
                                            if(in_array($key,$candidate_qualifcation_name)){
                                            for($j=0;$j<count($qualification);$j++){ 
                                                    if(self::comparissionEquals($qualification[$j]['qualificationname'],$key) && self::comparissionEquals($qualification[$j]['subject'],$value))
                                                    {
                                                        $resultexp_qual = $resultexp_qual + 1;
                                                    }
                                            }    
                                            }else{
                                                break;
                                            }                                          
                                        }
                                    }

                                    if($resultexp_qual == 0){
                                        $condition['conditionError'] = 'Experience with Qualification failed';                    
                                        array_push($arryOfConditionErr, $condition['conditionError']);             
                                    } 


                                    $qualification = $masterData['qualification'];
                                
                
                                    
                                    $qualification_criteria_bca = config('qualification.qualification_name.bca');
                                
                                        $qualification_criteria_dca = config('qualification.qualification_name.dca');

                                        $qualification_criteria_ccna = config('qualification.qualification_name.ccna');                                                                            
                                                            
                                            for($j=0;$j<count($qualification);$j++){ 
                                                    array_push($candidate_qualifcation_name,$qualification[$j]['qualificationname']);                                               
                                                }
                                                
                                        foreach($qualification_criteria_bca as $key=>$value){
                                            if(in_array($key,$candidate_qualifcation_name) && in_array($value,$candidate_qualifcation_name)){
                                                    $resultexp_qual = $resultexp_qual + 1;
                                                }
                                            }

                                            foreach($qualification_criteria_dca as $key=>$value){
                                            if(in_array($key,$candidate_qualifcation_name) && in_array($value,$candidate_qualifcation_name)){
                                                    $resultexp_qual = $resultexp_qual + 1;
                                                }
                                            }

                                            foreach($qualification_criteria_ccna as $key=>$value){
                                            if(in_array($key,$candidate_qualifcation_name) && in_array($value,$candidate_qualifcation_name)){
                                                    $resultexp_qual = $resultexp_qual + 1;
                                                }
                                            }

                                    
                                    
                                            if($resultexp_qual == 0)
                                            {
                                                $condition['conditionError'] = 'Candidate must be qualify with Two Degree';                    
                                                array_push($arryOfConditionErr, $condition['conditionError']);             
                                            }
                                    }                        
                } 
    } 
               
            
    
    // else{
    //     array_push($arryOfConditionErr, $arryOfReservationErr); 
    // }

    // array_push($arryOfConditionErr,['Reservation'=>$arryOfReservationErr]);  
        //   dd(count($arryOfConditionErr),count($arryOfReservationErr));
        if($jobId == 1 || $jobId == 4 || $jobId == 7 ||$jobId == 8 || $jobId == 9) 
        {
                if(count($arryOfConditionErr) >= 1 || count($arryOfReservationErr) >= 1){        
                    return ['status'=>'multipleError','Qual_exp'=>$arryOfConditionErr,'Reservation'=>$arryOfReservationErr];
                }else{           
                    return ['status'=>'success'];
                }
        }else if($jobId == 2 || $jobId == 3 || $jobId ==5 || $jobId == 6  ){
                if($Total_count == $result){
                    return ['status'=>'success'];
                }else{
                    return ['status'=>'multipleError','Qual_exp'=>$arryOfConditionErr,'Reservation'=>$arryOfReservationErr];
                }
        }
        else{
            if(count($arryOfConditionErr) >= 1 || count($arryOfReservationErr) >= 1){
            return ['status'=>'multipleError','Qual_exp'=>$arryOfConditionErr,'Reservation'=>$arryOfReservationErr];
            }
        }

    } 



    public static function isEligible($criteriaUnit,$masterData)
    {      
       
        switch ($criteriaUnit['type']) {
            case 'Field':
                return self::evalField($criteriaUnit,$masterData);
                break;
            case "Or":
            if($criteriaUnit['conditionType']==='qualification')
              {
                // echo 'qual';

                // echo "<br>";
                // echo "<pre>";
                // print_r($masterData);
                // die();
                return self::isEligibleOrWithAndLoop($criteriaUnit,$masterData);
                break;  
            }else if($criteriaUnit['conditionType']==='experience'){
                // echo 'exp';
                // print_r($criteriaUnit);
                // echo "<br>";
                return self::isEligibleOrWithAndLoop($criteriaUnit,$masterData);
                break;

            }else{
                return self::isEligibleOr($criteriaUnit,$masterData);
                break;  
            }
            case "And":
            if($criteriaUnit['conditionType']==='reservation'){

                return self::isEligibleAnd($criteriaUnit,$masterData);
                break;  
            }else{
                return self::isEligibleAndLoop($criteriaUnit['children'],$masterData,count($criteriaUnit['children']));
                break;  
            }
            default:
                # code...
                break;
        }
    }
     public static function isEligibleLoop($criteriaUnit,$masterData)
    {
        // echo "<pre>";
        //  print_r($criteriaUnit);
        //  echo "<br>";
        //  echo "<pre>";
        //  print_r($masterData);
         // die();
        switch ($criteriaUnit['type']) {
            case 'Field':  
                return self::evalField($criteriaUnit,$masterData);
            break; 
            case "And":        
            if($criteriaUnit['conditionType']=='qualification' || $criteriaUnit['conditionType']=='experience'){
                return self::isEligibleAndLoop($criteriaUnit['children'],$masterData,count($criteriaUnit['children']));
                break;  
            }          
            default:
                # code...
            break;
        }
    }

    public static function evalField($criteriaUnit,$masterData){
        $comparission=$criteriaUnit['comparison'];
        $fieldTable=$criteriaUnit['fieldTable'];
        $criteriaValue=$criteriaUnit['value'];

        if(empty($fieldTable)){
            $fieldTableArr=$masterData[$fieldTable]?? array() ;
          
            if(count($fieldTableArr)=='0') return '0'; 
            foreach($fieldTableArr as $data)
            {
                $candidateValue=$data[$criteriaUnit['fieldName']]??'0';               
                 $camparissionValue=self::comparissionSwitch($comparission,$candidateValue,$criteriaValue);
                 if($camparissionValue=='1') break;  
            }
        }else{
            $candidateValue=$masterData[$criteriaUnit['fieldName']]??'0';  
            $camparissionValue=self::comparissionSwitch($comparission,$candidateValue,$criteriaValue);
        }
     
        return $camparissionValue;      
    }
    public static function comparissionSwitch($comparission,$candidateValue,$criteriaValue)
    {
            switch ($comparission) {
            case 'Equals':
                return self::comparissionEquals($candidateValue,$criteriaValue);
                break;
            case 'notEquals':
                return self::comparissionNotEquals($candidateValue,$criteriaValue);
                break;
            case 'greaterThan':
                return self::comparissionGreaterThan($candidateValue,$criteriaValue);
                break; 
            case 'lesserThan':
                return self::comparissionLesserThan($candidateValue,$criteriaValue);
                break;                  
            case 'notBetween':
                return self::comparissionNotBetween($candidateValue,$criteriaValue);
                break;
            case 'dateBetween':
                return self::comparissionDateBetween($candidateValue,$criteriaValue);
                break;
            case 'In':
                return self::comparissionIn($candidateValue,$criteriaValue);
                break;
            case 'notIn':
                return self::comparissionNotIn($candidateValue,$criteriaValue);
                break; 
            case 'greaterThanEqualsTo':
                return self::comparissionGreaterThanEqualsTo($candidateValue,$criteriaValue);
                break;    
            case 'lessThanEqualsTo':
                return self::comparissionLessThanEqualsTo($candidateValue,$criteriaValue);
                break;     
                                   
            default:
                return '0';
                break;
        }
    }
      public static function isEligibleAnd($criteriaUnit,$masterData)
    {
        
        foreach ($criteriaUnit as $key => $child) {
             $returnValue=self::isEligible($child,$masterData);
            if ($returnValue=='0'){
                return '0';
                break;
            }
        }
         return '1';
    }

       public static function isEligibleOrWithAnd($criteriaUnit,$masterData)
        {              

                    $studentData = $masterData;
                    $success = 0; 
                   
                    foreach ($criteriaUnit as $key => $children) { 
                       
                        $count_creiteria = $children['successvalue'];
                        if($children['type'] == 'And'){
                            foreach($children['children'] as $child){
                               
                                $returnValue=self::evalField($child,$studentData);
                          
                                 if ($returnValue == 1){
                                       $success = $success + 1; 
                                    }    

                                    // echo $count_creiteria.'='.$success;                             
                                if($count_creiteria==strval($success)){
                                     return '1';
                                     break;                                   
                                }
                            }
                        }else{                          
                    
                                $returnValue=self::evalField($children,$studentData);    

                                  if ($returnValue == 1){
                                       $success = $success + 1; 
                                    }  
                    
                                if($count_creiteria==strval($success)){
                                     return '1';
                                     break;                                   
                                }                         


                        }
                            $success = 0;
                    }     
             return '0'; 
        }

    public static function isEligibleOrWithAndLoop($criteriaUnit,$masterData)
    {                     
    // echo "<pre>";
    // print_r($criteriaUnit);
    // die(); 
                   $count_creiteria = $criteriaUnit['successvalue'];
                   $success ='0';
                   foreach ($criteriaUnit['children'] as $key => $criteria['children']) { 
                        
                       $returnValue=self::isEligibleOrAndLoop($criteria['children'],$masterData); 
                       // echo $returnValue;
                       // die();
                        if ($returnValue=='1'){
                            $success = $success + 1; 
                        }
                    } 

                       // echo 'isEligibleOrWithAndLoop'.$success.'='.$count_creiteria;
                       //   echo "<br>";
                    
                         
                    if(self::comparissionGreaterThanEqualsTo(intval($success),intval($count_creiteria))){
                        return '1';
                    }
                                
    }

    public static function isEligibleOrAndLoop($criteriaUnit,$masterData)
    {   
                    // echo "<br>";
                                // echo "<pre>";
                                // print_r($criteriaUnit);
                                // die();
      // echo $criteriaUnit['successvalue'];
     $count_creiteria = $criteriaUnit['successvalue'];
       if($criteriaUnit['type']==='And'){
                   
                        $success ='0'; 
                        // echo count($masterData);                      
                        foreach ($masterData as $key => $studentData) {                       
                                // echo "<br>";
                                // echo "<pre>";
                                // print_r($studentData);
                         
                                foreach ($criteriaUnit['children'] as $key => $child) { 
                                    // echo "<br>";
                                    // echo "<pre>";
                                    // print_r($child);
                                    // echo "<br>";
                                       
                                    $returnValue=self::evalField($child,$studentData);              
                                       if ($returnValue=='1'){
                                            $success = $success + 1; 
                                        }
                                    //     echo 'isEligibleOrAndLoop'.$success.'='.$count_creiteria;
                                    //  echo "<br>";
                                      if(self::comparissionEquals(strval($success),strval($count_creiteria))){    
                                            return '1';
                                             $success ='0';    
                                        }                                   
                                    }                                    
                                    $success ='0';
                    }                                        
       }else if($criteriaUnit['type']==='Or'){

       }  

        
    }



    public static function isEligibleAndLoop($criteriaUnit,$masterData,$count_creiteria)
    {    

        $success =0;
        foreach ($masterData as $key => $studentData) {  
            // echo  "<br>";
        // echo 'count'.$count_creiteria;
            // print_r($studentData);
                foreach ($criteriaUnit as $key => $child) {                    
                    // echo  "<br>";
                    // // echo 'count'.$count_creiteria;
                    // print_r($child);
                    $returnValue=self::isEligibleLoop($child,$studentData);
                            // echo $returnValue;       
                       if ($returnValue=='1'){
                                $success++; 
                            }
                    }
                    if($count_creiteria==$success){
                        return '1';
                        $success ='0'; 
                    }
                    $success ='0'; 
        }   

    }

    public static function isEligibleOr($criteriaUnit,$masterData)
    {     
        // echo "<pre>";
        // print_r($criteriaUnit);
        // die();
        foreach ($criteriaUnit as $key => $child) {            
            // echo 'type:'.$child['type'];
            // die();
            if($child['type']=='And'){
                    return self::isEligibleAnd($child['children'],$masterData);
                    if ($returnValue=='1'){
                            return '1';
                            break;
                    } 
            }else if($child['type']=='Or'){
                $returnValue=self::isEligibleOr($child,$masterData);
                                if ($returnValue=='1'){
                                    return '1';
                                    break;
                                } 
            }else{                
                $returnValue=self::isEligible($child,$masterData);
                if ($returnValue=='1'){
                    return '1';
                    break;
                } 
            }
        }
        return '0';
    }



    public static function comparissionEquals($candidateValue,$criteriaValue){
        return ($candidateValue==$criteriaValue) ? '1' :'0';
    }
    public static function comparissionNotEquals($candidateValue,$criteriaValue){
        return ($candidateValue!=$criteriaValue) ? '1' :'0';
    }
    public static function comparissionGreaterThan($candidateValue,$criteriaValue){
        return ($candidateValue > $criteriaValue) ? '1' :'0';
    }
      public static function comparissionLesserThan($candidateValue,$criteriaValue){
        return ($candidateValue < $criteriaValue) ? '1' :'0';
    }
    public static function comparissionNotBetween($candidateValue,$criteriaValue){
        $toRange=$criteriaValue[1];
        $fromRange=$criteriaValue[0];
        return (!($candidateValue >= $fromRange && $candidateValue <= $toRange)) ? '1' :'0';
    }
    public static function comparissionDateBetween($candidateValue,$criteriaValue){
        $toRange=$criteriaValue[1];
        $fromRange=$criteriaValue[0];
        $dateCheck=Carbon::parse($candidateValue)->between($fromRange, $toRange);
        return (!$dateCheck) ? '1' :'0';
    }
    public static function comparissionIn($candidateValue,$criteriaValue){
        return (in_array($candidateValue, $criteriaValue)) ? '1' :'0';
    }
    public static function comparissionNotIn($candidateValue,$criteriaValue){
        return (!in_array($candidateValue, $criteriaValue)) ? '1' :'0';
    }
    public static function comparissionGreaterThanEqualsTo($candidateValue,$criteriaValue){
        return ($candidateValue >= $criteriaValue) ? '1' :'0';
    }
    public static function comparissionLessThanEqualsTo($candidateValue,$criteriaValue){
        return ($candidateValue <= $criteriaValue) ? '1' :'0';
    }
    

}
