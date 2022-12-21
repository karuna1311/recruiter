<?php

namespace App\Http\Controllers\User;
use Gate;
use Storage;
use Response;
use Exception;
use RequestIp;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\SessionMaster;
use App\Models\AdminJobPayment;
use App\Models\AppliedJobByUser;
use App\Services\PaymentService;
use App\Models\EligibleCandidates;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AdminJobGroupPayment;
use Illuminate\Support\Facades\Auth;
use App\Services\SessionMasterService;
use Illuminate\Database\QueryException;
use Illuminate\Database\Events\QueryExecuted;
use App\Http\Requests\User\PaymentUpdateRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
    	abort_if(Gate::denies('payment'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        // show candidate applied job based on that candidate will pay the fees of that job
        $user_id = Auth::User()->id;
        $candidate_data = array(); 
        $jobfees = array(); 
        $jobgroupfees = array(); 
     
        // $job_applied = AppliedJobByUser::Select('applied_job_by_user.user_id','applied_job_by_user.job_id','applied_job_by_user.payment_status','applied_job_by_user.json','applied_job_by_user.user_id')                                
        //                         ->where('applied_job_by_user.user_id',$user_id)
        //                         ->get();

        $eligible_candidates = EligibleCandidates::Select('applied_job_by_user.user_id','applied_job_by_user.job_id','applied_job_by_user.payment_status','applied_job_by_user.json','applied_job_by_user.user_id')
        ->join('applied_job_by_user','applied_job_by_user.eligible_cand_id','=','eligible_candidates.id')
        ->where(
            [
                'eligible_candidates.status' => 1,
                'eligible_candidates.user_id' => $user_id
            ]
        )->get();
        
                                
        foreach($eligible_candidates as $value){
            $json_decode                  = json_decode($value->json);          
           $data['job_id']                = $value->job_id;  
           $data['user_id']                = $value->user_id;  
           $data['caste']                 = $json_decode->cate; 
           $data['ph']                    = $json_decode->ph;  
           $data['ex_serviceman']         = $json_decode->ex_serviceman; 
           array_push($candidate_data,$data);
        }
      
        $m = 1;
        foreach($candidate_data as $value){
        //    check criteria set by admin for caste and sub caste make a function

            $fees = AdminJobPayment::Select('job_payment.id','job_payment.fees','job_payment.job_id','job_payment.caste','job_payment.sub_caste','job_payment.description',
            'applied_job_by_user.payment_status')
                    ->join('recruiter.eligible_candidates','eligible_candidates.job_id','=','job_payment.job_id')
                    ->join('recruiter.applied_job_by_user','applied_job_by_user.eligible_cand_id','=','eligible_candidates.id')
                    ->where('job_payment.job_id',$value['job_id'])
                    ->where('eligible_candidates.status',1)
                    ->where('applied_job_by_user.user_id',$value['user_id']);
           


                    
          if($value['caste']==='SC'){
                $fees = $fees->where('caste',$value['caste'])
                ->first();  
            }
            else if($value['caste']==='ST'){
                $fees = $fees->where('caste',$value['caste'])
                ->first();  
            }
            else if($value['caste']==='DT-A'){
                $fees = $fees->where('caste',$value['caste'])
                ->first();  
            }
            else if($value['caste']==='NT-B'){
                $fees = $fees->where('caste',$value['caste'])
                ->first(); 
            }
            else if($value['caste']==='NT-C'){
                $fees = $fees->where('caste',$value['caste'])
                ->first(); 
            }
            else if($value['caste']==='NT-D'){
                $fees = $fees->where('caste',$value['caste'])
                ->first();  
            }
            else if($value['caste']==='SBC'){
                $fees = $fees->where('caste',$value['caste'])
                ->first();  
            }
            else if($value['caste']==='SEBC'){
                $fees = $fees->where('caste',$value['caste'])
                ->first();  
            }
            else if($value['caste']==='EWS'){
                $fees= $fees->where('caste',$value['caste'])
                ->first();  
            }
            else if($value['caste']==='OBC'){
                $fees = $fees->where('caste',$value['caste'])
                ->first();  
            } 
            else if($value['caste']==='UNRESERVED'){
            $fees = $fees->where('caste',$value['caste'])
            ->first();  
            }         
               
                // $increvalue = ($fees!=null) ? $m++ : null;
                if($fees!=null){
                array_push($jobfees,$fees);
                }
        }
    //    dd($jobfees);
       
        return view('user.Payment.index',compact('jobfees'));
    }
    public function store(Request $request)
    {
       
       if(in_array(null, $request->amount, true) || in_array('', $request->amount, true)){
                return redirect()->route('payment.index')->with('msg_error','Please select any one payment first');         
        }
        try{
           
                $serverfees = array();
                $user_id = Auth::id();
                
                $user = User::find($user_id);

                $amount = $request->amount;
                $groupamount = $request->group_amount;
                
                $total_amount = array_sum($amount);
                // $total_groupamount = array_sum($groupamount);
                
                $final_amount = $total_amount;  //+$total_groupamount;

                $job_wise = $request->postwisejob_id;
                $job_id = $request->job_id;

                foreach($job_wise as $value){
                    $fees = AdminJobPayment::Select('fees')
                        ->where('id',$value)
                        ->first();
                        
                    array_push($serverfees,$fees->fees);
                }
            

                if(array_sum($serverfees) != $final_amount){
                    return redirect()->route('payment.index')->with('msg_error','Server Error, Please contact to Admin');
                }else{
                    $orderId=date('ymdhis').$user->id;          

                    $paymentData = new Transaction();
                    $paymentData->user_id = $user->id;
                    $paymentData->payment_id = json_encode($job_wise);
                    $paymentData->job_id = json_encode($job_id);
                    $paymentData->amount = $final_amount;
                    $paymentData->order_id = $orderId;
                    $paymentData->order_status = 'Initiate';
                    $paymentData->cname     = $user->name;
                    $paymentData->save();
                   
                    $payment_user['user_id']        = $user_id;
                    $payment_user['mobile']         = $user->mobile;
                    $payment_user['email']          = $user->email;
                    $payment_user['name']           = $user->name;
                    $payment_user['checksum']       = env('CheckSumKey');
                    $payment_user['merchantId']     = env('PAYMENT_MERCHANT_ID');
                    $payment_user['currencyCode']   = 'INR';
                    $payment_user['amount']         = $final_amount;
                    $payment_user['order_id']       = $orderId;
                    $payment_user['job_wise']       = json_encode($job_wise);
                    // $payment_user['groupjob_wise']  = $groupjob_wise;
                    $payment_user['created_at']     = Carbon::now()->format('Y-m-d H:i:s');;
        
                    return view('user.Payment.form',compact('payment_user'));    
                }      
                    
        }catch(QueryException $e){
            
            return redirect()->route('payment.index')->with('msg_error',$e->getMessage());  
        }
        catch(Exception $e){
            return redirect()->route('payment.index')->with('msg_error',$e->getMessage());  
        }
     
 
    
    }


    public function updatePayment(Request $request)
    {
        $user=Auth::user();
        $arryOfpaymentResponse=$request->all();
      
        $dataSize=sizeof($arryOfpaymentResponse);

        for($i = 0; $i < $dataSize; $i++) 
        {
            $information=explode('=',$arryOfpaymentResponse[$i]);
            if($i==0)   $order_id=$information[1];
            if($i==1)   $tracking_id=$information[1];
            if($i==2)   $bank_ref_no=$information[1];
            if($i==3)   $order_status=$information[1];
            if($i==8)   $status_message=$information[1];
            if($i==10)  $amount=$information[1];
            if($i==26)  $merchant_param1=$information[1];
            if($i==27)  $merchant_param2=$information[1];
            if($i==28)  $merchant_param3=$information[1];
            if($i==29)  $merchant_param4=$information[1];
            if($i==40)  $trans_date=$information[1];
        }
        try{
                $order_status = strtoupper($order_status);
                
                $paymentInfoUpdate=Transaction::where('order_id',$order_id)
                ->update([
                    'tracking_id'=>$tracking_id,
                    'bank_transaction_no'=>$bank_ref_no,
                    'order_status'=>$order_status,
                    'response'=>json_encode($arryOfpaymentResponse),
                    'updated_at'=>Carbon::now()
                ]);

                $transactionInfoId= Transaction::where('order_id',$order_id)->select('id','created_at')->get();


                if($order_status=='SUCCESS'){
                    try{

                        Payment::Insert(
                            [
                                'user_id' => $merchant_param2,                                
                                'amount' => $amount,
                                'order_id' => $order_id,
                                'tracking_id'=>$tracking_id,
                                'bank_ref_no'=>$bank_ref_no,
                                'order_status'=>$order_status,
                                'transaction_info_id'=>$transactionInfoId[0]['id'],                        
                                'payment_response_json'=>json_encode($arryOfpaymentResponse),
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now()
                            ]);
                            
                            $job = Transaction::where('order_id',$order_id)->select('job_id')->first();
                            
                            
                            $decode_job = json_decode($job->job_id);
                            foreach($decode_job as $value){           
                                
                                AppliedJobByUser::where('user_id',$merchant_param2)
                                        ->where('job_id',$value)
                                        ->update([    
                                            'bank_ref_no'    =>   $order_id,         // orderid of candidate               
                                            'payment_status'=>$order_status,                                
                                            'updated_at'=>Carbon::now()
                                        ]);
                            }
                                                
                                                
                        User::where('id',$merchant_param2)->update(['application_status'=>'8']);
                                                
                        return Response::json(['status'=>'success','message'=>$order_status]);   
                    
                        }catch(QueryException $Qexception )
                        {
                            return Response::json(['status' => 'error','message'=>$Qexception->getMessage()]);
                        }
                    
                } return Response::json(['status' => 'error','message'=>$order_status]);
    }catch(QueryException $Qexception)
        {
            return Response::json(['status' => 'error','message'=>$Qexception->getMessage()]);
        }catch(Exception $e)
        {
            
            return Response::json(['status' => 'error','message'=>$e->getMessage()]);
        }
    }
        
    

  

    public function show(Request $request){
            dd('show here');
    } 

    public function destroy($id){
        
    }

    public function unlockProfile(Request $request){
      
        try{
            $user=Auth::USER();
            $user_id = $user->id;

            $user = User::find($user_id);         
            $user->application_status = '6';
            $user->status_lock = '0';            
            $user->save();

            return redirect()->route('applicationstatus.index');

        }catch(QueryException $e) {
            return redirect()->route('payment.index')->with('msg_error',$e->getMessage());            
        }
    }   
    
    

     
}
