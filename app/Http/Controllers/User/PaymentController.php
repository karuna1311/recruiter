<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Services\SessionMasterService;
use App\Models\SessionMaster;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Requests\User\PaymentUpdateRequest;
use Exception;
use Gate;
use Response;
use Storage;
use Carbon\Carbon;
use RequestIp;

class PaymentController extends Controller
{
    public function index()
    {
    	abort_if(Gate::denies('payment'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
    	$scheduleData=SessionMasterService::checkPaymentEligibility();
        return view('user.Payment.index',compact('scheduleData'));
    }
    public function store(SessionMaster $sessionId)
    {
    	try{
            $isEligible=SessionMasterService::checkPaymentEligibilitySession($sessionId->id);
            abort_if(!$isEligible, HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
            $paymentData=PaymentService::initiatePayment($sessionId->id,$sessionId->fee_json);
        }catch(Exception $e){
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return view('user.Payment.form',compact('paymentData'));
    }
    public function update(PaymentUpdateRequest $request,Transaction $transaction)
    {
       try{
			$isValidResponse=PaymentService::checkPaymentResponse($request->msg);
			if(!$isValidResponse) {
                return redirect()->route('login')->with('paymentFail','Unauthorised');
            }
            $responseArry=explode('|',$request->msg);
            $status=$responseArry[0];
			if($status==='S') 
			{
                $alertStatus='paymentSuccess';
                $message='Payment Successful, please login to check status';
				$paymentData=$transaction->update(['order_status'=>$status,'response'=>$request->msg,'bank_transaction_no'=>$responseArry[11]]);
				Payment::updateOrCreate(['user_id'=>$transaction->user_id,'session_master_id'=>$transaction->session_master_id],['order_id'=>$transaction->order_id,'amount'=>$transaction->amount,'bank_transaction_no'=>$responseArry[11]]);
				User::where('id',$transaction->user_id)->update(['application_status'=>'10']);
			}else{
                $alertStatus='paymentFail';
                $message='Payment Failed';
				$paymentData=$transaction->update(['order_status'=>$status,'response'=>$request->msg]);
			}
			return redirect()->route('login')->with($alertStatus,$message);
        }catch(Exception $e){
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
    }
    public function updatePushResponse(PaymentUpdateRequest $request)
    {
       try{
            $logdata=Carbon::now().'|'.RequestIp::ip().'|';
            $isValidResponse=PaymentService::checkPaymentResponse($request->msg);
            if(!$isValidResponse) {
                $logdata.=$request->msg.'|'.'UNAUTHORISED';
                $logFile=Storage::disk('uploads')->append('/NSDLPushResponse/unauthorisedlog.txt',$logdata);
                return '400|N|Invalid Check Sum';
            }
            $responseArry=explode('|',$request->msg);
            $status=$responseArry[0];
            if($status==='S') 
            {
                $userId=ltrim($responseArry[5],'0');
                $orderId=$responseArry[4];
                $paymentData=Transaction::where('order_id',$orderId)->update(['order_status'=>$status,'response'=>$request->msg,'bank_transaction_no'=>$responseArry[11]]);
                $user=User::where('id',$userId)->select('application_status')->first();
                if($user->application_status < 10){
                    Payment::updateOrCreate(['user_id'=>$userId,'session_master_id'=>$responseArry[14]],['order_id'=>$orderId,'amount'=>$responseArry[6],'bank_transaction_no'=>$responseArry[11]]);
                    User::where('id',$userId)->update(['application_status'=>'10']);
                    $logdata.=$request->msg.'|'.'PAYMENT_TABLE_UPDATED';
                    $logFile=Storage::disk('uploads')->append('/NSDLPushResponse/successlog.txt',$logdata);
                }else{
                    $logdata.=$request->msg.'|'.'DOUBLE_PAYMENT';
                    $logFile=Storage::disk('uploads')->append('/NSDLPushResponse/doublepayementlog.txt',$logdata);
                }  
            }else{
                $logdata.=$request->msg.'|'.'PAYMENT_FAILED';
                $logFile=Storage::disk('uploads')->append('/NSDLPushResponse/faillog.txt',$logdata);
            }
            return '200|Y|SUCCESSFUL';
        }catch(Exception $e){
            $logFile=Storage::disk('uploads')->append('/NSDLPushResponse/errorlog.txt',$e->getMessage());
            return '400|N|System Exception';
        }
    }
}
