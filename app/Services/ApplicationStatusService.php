<?php

namespace App\Services;
use Auth;

class ApplicationStatusService 
{
    public static function getApplicationStatus()
    {
      $user = Auth::user();
        $statusId=$user->application_status ?? 0;
        $appStatusArray=config('application.application_status');
        foreach($appStatusArray as $key=>$appStatus){
          if($key<=$statusId){
            $appStatusArray[$key]['status']='Complete';
          }else{
            $appStatusArray[$key]['status']='Incomplete';
          }
        }
        return $appStatusArray;
    }
    public static function getIncompleteApplicationStatus(){
        $user = Auth::user();
        $statusId=$user->application_status ?? 0;
        $appStatusArray=config('application.application_status');
        $incompleteStatusArray=$appStatusArray[++$statusId] ?? array();
        return $incompleteStatusArray;
    }

}
