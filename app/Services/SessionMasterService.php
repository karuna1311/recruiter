<?php

namespace App\Services;
use Auth;
use App\Models\UserReservation;
use App\Models\SessionMaster;
use App\Models\ScheduleMaster;
use Carbon\Carbon;
use Storage;
use App\Services\ScheduleMasterService;
class SessionMasterService 
{
    public static function getCandidateCutOff($criteriaJson,$phStatus,$catergory)
    {
        $cutOffArray=json_decode($criteriaJson,true);
        if(!in_array($catergory, ['OPEN','EWS'])) $catergory='CATE'; else $catergory='OPEN';
        return $cutOffArray['PH'][$phStatus][$catergory];
    }
    public static function checkEligibity($sessionData)
    {
        $dateCheck=Carbon::now()->between($sessionData->start_date, $sessionData->end_date);
        if(!$dateCheck) return ['status'=>'error','data'=>'Session Expired'];
        $criteriaJson=$sessionData->cutoff_json;
        $user=Auth::user();
    	$neetMarks=$user->neet_marks;
        $neetYear=$user->neet_year;
        if($sessionData->session_year!=$neetYear) return ['status'=>'error','data'=>'Not Eligible.(NEET passing year)'];
    	$masterDataObj=UserReservation::first();
        $masterData=$masterDataObj->toArray();
        $applicableCheck=self::checkApplicableCriteria($sessionData->id,$masterData);
        if(count($applicableCheck) && $applicableCheck['status']!='success') return $applicableCheck;
    	$cuttOfRange=self::getCandidateCutOff($criteriaJson,$masterData['ph'],$masterData['cate']);
    	if(!(($cuttOfRange['CUTTOFF_FROM'] <= $neetMarks) && ($neetMarks <= $cuttOfRange['CUTTOFF_TO']))) return ['status'=>'error','data'=>'Not Eligible.Please Check cutoff'];
        try{
            $masterDataObj->session_master_id=$sessionData->id;
            $masterDataObj->save();
            $user->application_status='9';
            $user->save();
        }catch(\Exception $e){
            return ['status'=>'error','data'=>$e->getMessage()];
        }
        return ['status'=>'success'];
           
    }
    public static function getActiveSessionWithCutoff(){
    	$masterData=UserReservation::select('ph','cate','security_deposite_amount')->first();
        $activeSession=self::getActiveSession();
        foreach($activeSession as $key=>$session){
        	$cuttOfRange=self::getCandidateCutOff($session->cutoff_json,$masterData->ph,$masterData->cate);
        	$activeSession[$key]->cutoffRange=$cuttOfRange['CUTTOFF_FROM'].'-'.$cuttOfRange['CUTTOFF_TO'];
            $activeSession[$key]->securityDeposite=$masterData->security_deposite_amount;
            $activeSession[$key]->ph=$masterData->ph;
            $activeSession[$key]->cate=$masterData->cate;
        }
        return $activeSession;
    }
    public static function getActiveSession(){
        $dt=Carbon::now();
        $neetYear=Auth::user()->neet_year;
        return SessionMaster::whereRaw('"'.$dt.'" between `start_date` and `end_date`')->where([['is_active','1'],['session_year',$neetYear]])->get();
    }
    public static function checkPaymentEligibilityzzz()
    {
        $masterData=UserReservation::select('session_master_id','security_deposite_amount')->get();

        $getActiveSession=self::getActiveSession();
        $isEligible=$getActiveSession->contains('id',$masterData->session_master_id);
        foreach ($getActiveSession as $key => $value) {
            $value->fee_json=$value->fee_json+$masterData->security_deposite_amount;
        }
        if($isEligible) return $getActiveSession;
        return $isEligible;
    }
    
    public static function checkPaymentEligibility()
    {
        $masterData=UserReservation::pluck('security_deposite_amount','session_master_id')->all();
        $dt=Carbon::now();
        $scheduleData=ScheduleMaster::with('sessionData:id,session_name,fee_json')->where('name','Payment')->whereIn('session',array_keys($masterData))->whereRaw('"'.$dt.'" between `start_date` and `end_date`')->select('name','session','start_date','end_date')->get();
        foreach($scheduleData as $key=>$schedule){
            $scheduleData[$key]->sessionData->sessionFee=$schedule->sessionData->fee_json;
            $scheduleData[$key]->sessionData->securityDeposite=$masterData[$schedule->sessionData->id];
            $scheduleData[$key]->sessionData->total=$schedule->sessionData->fee_json+$masterData[$schedule->sessionData->id];
        }
        return $scheduleData;
    }
    public static function checkPaymentEligibilitySession($sessionId){
        $masterData=UserReservation::select('session_master_id')->first();
        $dt=Carbon::now();
        if(($sessionId==$masterData->session_master_id) && ScheduleMaster::where([['session',$sessionId],['name','Payment']])->whereRaw('"'.$dt.'" between `start_date` and `end_date`')->exists())  return '1'; else return '0';
    }
    public static function checkApplicableCriteria($sessionId,$masterData)
    {
        if(!Storage::disk('uploads')->exists('SessionCriteria/'.$sessionId.'.json')) return ['status'=>'error','data'=>'Session criteria file not found'];
        $conditionArray=json_decode(Storage::disk('uploads')->get('SessionCriteria/'.$sessionId.'.json'),true);
        $arryOfConditionErr=array();
        foreach($conditionArray as $condition){
            
            foreach ($condition['conditionCriteria'] as $key => $conditionCriteria) {
                $returnvalue=self::isEligible($conditionCriteria,$masterData);
                if($returnvalue=='1') break;
            }
            if($returnvalue=='1') $arryOfConditionErr[]=$condition['conditionError']; 
        }
        if(count($arryOfConditionErr)) return ['status'=>'multipleError','data'=>$arryOfConditionErr];
        return ['status'=>'success'];
        
    }
    public static function isEligible($criteriaUnit,$masterData)
    {
        switch ($criteriaUnit['type']) {
            case 'Field':
                return self::evalField($criteriaUnit,$masterData);
                break;
            case "Or":
                return self::isEligibleOr($criteriaUnit['children'],$masterData);    
                break;
            case "And":
            return self::isEligibleAnd($criteriaUnit['children'],$masterData);
                break;  
            default:
                # code...
                break;
        }
    }
    public static function evalField($criteriaUnit,$masterData){
        $comparission=$criteriaUnit['comparison'];
        $candidateValue=$masterData[$criteriaUnit['fieldName']]??'0';
        $criteriaValue=$criteriaUnit['value'];
        switch ($comparission) {
            case 'Equals':
                return self::comparissionEquals($candidateValue,$criteriaValue);
                break;
            case 'notEquals':
                return self::comparissionNotEquals($candidateValue,$criteriaValue);
                break;
            case 'notBetween':
                return self::comparissionNotBetween($candidateValue,$criteriaValue);
                break;            
            default:
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
    public static function isEligibleOr($criteriaUnit,$masterData)
    {
        foreach ($criteriaUnit as $key => $child) {
            $returnValue=self::isEligible($child,$masterData);
            if ($returnValue=='1'){
                return '1';
                break;
            } 
        }
        return '0';
    }
    public static function comparissionEquals($candidateValue,$criteriaValue){
        return ($candidateValue===$criteriaValue) ? '1' :'0';
    }
    public static function comparissionNotEquals($candidateValue,$criteriaValue){
        return ($candidateValue!=$criteriaValue) ? '1' :'0';
    }
    public static function comparissionNotBetween($candidateValue,$criteriaValue){
        $toRange=$criteriaValue[1];
        $fromRange=$criteriaValue[0];
        return (!($candidateValue >= $fromRange && $candidateValue <= $toRange)) ? '1' :'0';
    }

}
