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
use App\Http\Requests\User\PaymentUpdateRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PaymentController extends Controller
{
    public function index()
    {
    	// abort_if(Gate::denies('payment'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
    	// $scheduleData=SessionMasterService::checkPaymentEligibility();

        // show candidate applied job based on that candidate will pay the fees of that job
        $user_id = Auth::User()->id;
        $candidate_data = array(); 
        $jobfees = array(); 
        $jobgroupfees = array(); 
        
        $job_applied = EligibleCandidates::Select('applied_job_by_user.job_id','applied_job_by_user.json')                                
                                ->leftjoin('applied_job_by_user','applied_job_by_user.job_id','=','eligible_candidates.job_id')
                                ->where('eligible_candidates.user_id',$user_id)
                                ->where('eligible_candidates.status',1)
                                ->get();
        
        foreach($job_applied as $value){
            $json_decode                  = json_decode($value->json);          
           $data['job_id']                = $value->job_id;  
           $data['caste']                 = $json_decode->cate; 
           $data['ph']                    = $json_decode->ph; 
           $data['ex_serviceman']         = $json_decode->ex_serviceman; 
           array_push($candidate_data,$data);
        }
        // dd($candidate_data);
        foreach($candidate_data as $value){
            if($value['ph']==='YES'){                
                $ph = ($value['ph']==='YES') ? 'ph' : '';

                $fees  = AdminJobPayment::Select('id','fees','job_id','caste','sub_caste','description')
                ->where('job_id',$value['job_id'])
                ->where('sub_caste',$ph)
                ->first();
               
                $groupfees  = AdminJobGroupPayment::Select('id','fees','job_id','group_name','caste','sub_caste')                
                ->whereJsonContains('job_id',(string)$value['job_id']) // (["3","5"],3)
                ->where('sub_caste',$ph)
                ->first();
              
                array_push($jobfees,$fees);
                array_push($jobgroupfees,$groupfees);
                
            }else if($value['ex_serviceman']==='YES'){
                $ex_serviceman = ($value['ex_serviceman']==='YES') ? 'ex_serviceman' : '';

                $fees  = AdminJobPayment::Select('id','fees','job_id','caste','sub_caste','description')
                ->where('job_id',$value['job_id'])
                ->where('sub_caste',$ex_serviceman)
                ->first();

                $groupfees  = AdminJobGroupPayment::Select('id','fees','job_id','group_name','caste','sub_caste')
                ->whereJsonContains('job_id',(string)$value['job_id']) // (["3","5"],3)
                ->where('sub_caste',$ex_serviceman)
                ->first();

                array_push($jobfees,$fees);
                array_push($jobgroupfees,$groupfees);
            }
            else{
                $fees  = AdminJobPayment::Select('id','fees','job_id','caste','sub_caste','description')
                ->where('job_id',$value['job_id'])
                ->where('caste',$value['caste'])
                ->first();                

                $groupfees  = AdminJobGroupPayment::Select('id','fees','job_id','group_name','caste','sub_caste')
                ->whereJsonContains('job_id',(string)$value['job_id']) // (["3","5"],3)
                ->where('caste',$value['caste'])
                ->first();

                array_push($jobfees,$fees);
                array_push($jobgroupfees,$groupfees);
            }
        }

        // dd($jobfees);
        // echo "<br>";
        // dd(var_dump((array)$jobgroupfees[0]['job_id']));
        
        return view('user.Payment.index',compact('jobfees','jobgroupfees'));
    }
    public function store(Request $request)
    {
    	try{
          
            $user_id = Auth::id();
            
            $user = User::find($user_id);

            $amount = $request->amount;
            $groupamount = $request->group_amount;
            
            $total_amount = array_sum($amount);
            $total_groupamount = array_sum($groupamount);
            
            $final_amount = $total_amount+$total_groupamount;

            $job_wise = $request->postwisejob_id;
            $groupjob_wise = $request->grouppostjob_id;

            $orderId=date('ymdhis').$user->id;          

            $paymentData = new transaction();
            $paymentData->user_id = $user->id;
            $paymentData->amount = $final_amount;
            $paymentData->order_id = $orderId;
            $paymentData->cname     = $user->name;
            $paymentData->save();
            
            $payment_user['user_id']        = $user_id;
            $payment_user['mobile']         = $user->mobile;
            $payment_user['email']          = $user->email;
            $payment_user['name']           = $user->name;
            $payment_user['checksum']    = env('CheckSumKey');
            $payment_user['merchantId']     = env('PAYMENT_MERCHANT_ID');
            $payment_user['currencyCode']   = 'INR';
            $payment_user['amount']         = $final_amount;
            $payment_user['order_id']       = $orderId;
            $payment_user['job_wise']       = $job_wise;
            $payment_user['groupjob_wise']  = $groupjob_wise;
            $payment_user['created_at']     = Carbon::now()->format('Y-m-d H:i:s');;

        return view('user.payment.form',compact('payment_user'));            
              
        }catch(Exception $e){
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
    }

  

    public function show(Request $request){
        
    }  

     
}
