<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Events\LoggingEvent;
use App\Models\Jobs;
use Illuminate\Support\Facades\Route;

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

    public static function jobName($id)
    {
        $job_id =  $id;
        
        if(isset($job_id))
        {
           $job_name = Jobs::Select('name')->where('id',$id)->first();
        }
        return $job_name->name;
    }

    public static function multipleJobName($id)
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
}
