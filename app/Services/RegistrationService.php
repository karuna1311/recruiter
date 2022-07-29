<?php

namespace App\Services;
use App\Models\NeetPgdResult;
use Carbon\Carbon;

class RegistrationService 
{
    public static function studentValidation($rollNo,$neetAppNo,$dob)
    {
        if($neetData=NeetPgdResult::where([['roll_no',$rollNo],['application_no',$neetAppNo],['dob',$dob],['flag','1']])->first()) 
        return ['status'=>'success','data'=>$neetData];
        else return ['status'=>'error','data'=>'Not found in NEET data'];
    }
}
