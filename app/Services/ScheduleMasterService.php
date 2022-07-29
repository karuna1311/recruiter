<?php

namespace App\Services;
use App\Models\ScheduleMaster;
use Carbon\Carbon;

class ScheduleMasterService 
{
    public static function checkSchedule($ScheduleName,$session)
    {
        $dt=Carbon::now();
        $scheduleData=ScheduleMaster::where([['name',$ScheduleName],['session',$session]])->select('name','session','start_date','end_date')->first();
        if(!$scheduleData) return ['status'=>'error','data'=>'Schedule Not Found'];
        $dateCheck=Carbon::now()->between($scheduleData->start_date, $scheduleData->end_date);
        if(!$dateCheck) return ['status'=>'error','data'=>$scheduleData->name.' allowed from '.date('d-m-Y h:i:s A',strtotime($scheduleData->start_date)).' to '.date('d-m-Y h:i:s A',strtotime($scheduleData->end_date))];
        return ['status'=>'success'];
    }
}
