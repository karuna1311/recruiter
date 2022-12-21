<?php

namespace App\Traits;

use App\Models\Jobs;
use App\Models\state;
use App\Models\lookup;
use App\Models\taluka;
use App\Models\subject;
use App\Models\district;
use App\Events\LoggingEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;

trait Convertors
{
    
    public static function comparisonName($op)
    {
        switch ($op) {
            case "=":  return 'Equals too';
            case "!=": return 'Not Equals too';
            case ">=": return 'Greater than equal too';
            case "=>": return 'Greater than equal too';
            case "<=": return 'Lesser than equal too';
            case ">":  return 'Greater';
            case "<":  return 'Lesser';
        default:       return false;
        } 
    }

    public static function postName($id)
    {
        $job_id =  $id;
        
        if(isset($job_id))
        {
           $job_name = Jobs::Select('name')->where('id',$id)->first();
        }
        return $job_name->name;
    }

    public static function multiplePostName($id)
    {
        $job_id =  json_decode($id);        
        $job_array = array();

        if(isset($job_id))
        {
            foreach($job_id as $job)
            {
                $job_name = Jobs::Select('name')->where('id',$job)->first();
                array_push($job_array,$job_name->name);
            }
        }
        return json_encode($job_array);
    }

    public static function phType($id)
    {
        $ph_type_id =  $id;
        
        if(isset($ph_type_id))
        {
            $disability  = lookup::select('label')->where('id',$ph_type_id)->first();
        }
        return $disability->label;
    }

    public static function competitionType($id)
    {
        $type_id =  $id;
        
        if(isset($type_id))
        {            
            $competition_type = lookup::select('label')->where('id',$type_id)->first();
        }
        return $competition_type->label;
    }

    public static function medalname($id)
    {
        $type_id =  $id;
        
        if(isset($type_id))
        {            
            $position_medal = lookup::select('label')->where('id',$type_id)->first();
        }
        return $position_medal->label;
    }

    public static function getStateByID($stateID=null){
        if(!empty($stateID)){
            $state = state::where('state_id',$stateID)->select('state_name')->first();
                return $state->state_name;
        }else{
            return null;
        }
    }

    public static function getDistrictById($districtId=null){

        if(!empty($districtId)){
            $district = district::where('district_id',$districtId)->select('district_name')->first();
                return $district->district_name;
        }else{
            return null;
        }
         
    }
    public static function getTalukaById($talukaId=null){
      
        if(!empty($talukaId)){
            $taluka = taluka::where('subdistrict_id',$talukaId)->select('subdistrict_name')->first();
                return $taluka->subdistrict_name;
        }else{
            return null;
        }
    }

    public static function subject($subjectId=null){
      
        if(!empty($subjectId)){
            $subject = subject::where('id',$subjectId)->select('subject_name')->first();
                return $subject->subject_name;
        }else{
            return null;
        }
    }

    public static function class($classId=null){
      
        if(!empty($classId)){
            $lookup = lookup::where('id',$classId)
            ->where('type','LIKE','%qualification_grade%')
            ->select('label')
            ->first();
                return $lookup->label;
        }else{
            return null;
        }
    }

    public static function mode($modeId=null){
      
        if(!empty($modeId)){
            $lookup = lookup::where('id',$modeId)
            ->where('type','LIKE','%qualification_mode%')
            ->select('label')->first();
                return $lookup->label;
        }else{
            return null;
        }
    }

    public static function designation($designationId=null){
      
        if(!empty($designationId)){
            $lookup = lookup::where('id',$designationId)
                ->where('type','LIKE','%post_name%')
                ->select('label')->first();
                return $lookup->label;
        }else{
            return null;
        }
    }

    
    public static function appointment($appointmentId=null){
      
        if(!empty($appointmentId)){
            $lookup = lookup::where('id',$appointmentId)
                ->where('type','LIKE','%appointment_nature%')
                ->select('label')->first();
                return $lookup->label;
        }else{
            return null;
        }
    }

    public static function jobnature($job_natureId=null){
      
        if(!empty($job_natureId)){
            $lookup = lookup::where('id',$job_natureId)
                ->where('type','LIKE','%job_nature%')
                ->select('label')->first();
                return $lookup->label;
        }else{
            return null;
        }
    }

    public static function university($universityID=null){
      
        if(!empty($universityID)){
            $university = DB::Table('university')
                    ->where('id',$universityID)             
                ->select('name')->first();
                return $university->name;
        }else{
            return null;
        }
    }
    

}
