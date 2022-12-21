<?php

namespace App\Http\Controllers\User;
use Auth;
use Gate;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\SessionMaster;
use App\Models\UserExperience;
use App\Models\UserReservation;
use App\Models\UserQualification;
use App\Http\Controllers\Controller;
use App\Models\AdminJobPayment;
use App\Models\AppliedJobByUser;
use App\Models\AppliedJobByUserExperience;
use App\Models\AppliedJobByUserQualification;
use App\Models\Jobs;
use App\Models\Transaction;
use App\Services\DocumentUploadService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AppliedJobPaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appliedJobPayment'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');     
        $user=Auth::USER();
        $user_id = $user->id;
        User::where('id',$user_id)->update(['application_status'=>'9']);
        
        $jobpayment = AppliedJobByUser::where('user_id',$user_id)
                                    ->select('job_adv.name','applied_job_by_user.job_id','applied_job_by_user.bank_ref_no as order_id','applied_job_by_user.application_no')
                                    ->join('recruiter_admin.job_adv','job_adv.id','=','applied_job_by_user.job_id')
                                    ->where('applied_job_by_user.payment_status','SUCCESS')                                  
                                    ->get();
        
        return view('user.AppliedJobPayment.index',compact('jobpayment','user'));
    }

    public function paymentReceipt($order_id,$job_id){
        $user=Auth::user();
        $order_id = base64_decode($order_id);
        $job_id = base64_decode($job_id);
        
        $payment_data=  AppliedJobByUser::Select('applied_job_by_user.bank_ref_no as order_id','applied_job_by_user.job_id','payment_info.amount')
        ->join('payment_info','payment_info.order_id','=','applied_job_by_user.bank_ref_no')
        ->where('applied_job_by_user.user_id',$user->id)
        ->where('applied_job_by_user.bank_ref_no',$order_id)
        ->where('applied_job_by_user.payment_status','SUCCESS')
        ->where('applied_job_by_user.job_id',$job_id)        
        ->get();
        
    
        $userData = ['name'=>$user->name,'mobile'=>$user->mobile,'email'=>$user->email,'dob'=>$user->dob];
        $mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $html=\View::make('user.Payment.receipt',compact('userData','payment_data'));
        // dd($html->render());
        $html=$html->render();
        $mpdf->SetHTMLFooter('<table style="width:100%;font-size:12px;border-top:0.5px solid #000;"><tr><td style="text-align:left;">'.Carbon::now()->format('d-m-Y h:i:s').'</td><td style="text-align:right;">{PAGENO}</td></tr></table>');
        $mpdf->WriteHTML($html);
        $mpdf->output('PaymentReceipt.pdf','D');
    }


    public function applicationReport($order_id,$job_id){
        $user=Auth::user();
        $order_id = base64_decode($order_id);
        $job_id = base64_decode($job_id);
        // dd($order_id,$job_id);

        $appliedjob = AppliedJobByUser::Select('id','json','application_no','job_id')
                                        ->where('user_id',$user->id)
                                        ->where('bank_ref_no',$order_id)
                                        ->where('job_id',$job_id)
                                        ->where('payment_status','SUCCESS')
                                        ->first();

            
    	$previewData= json_decode($appliedjob->json);
   
        $userData = ['name'=>$user->name,'mobile'=>$user->mobile,'email'=>$user->email,'dob'=>$user->dob];

        $documentData=DocumentUploadService::getDocumentList();
   
        
        $json_qualification = AppliedJobByUserQualification::where('user_id',$user->id)
        ->where('applied_job_id',$appliedjob->id)
        ->select('json')
        ->get();

   
        foreach($json_qualification as $value){
            $qualification = json_decode($value->json);              
        }

        $json_experience = AppliedJobByUserExperience::where('user_id',$user->id)
        ->where('applied_job_id',$appliedjob->id)
        ->Select('json')     
        ->get();

        foreach($json_experience as $value){
            $experience = json_decode($value->json);              
        }

        if(Storage::disk('uploads')->exists('photo/'.$user->photo)){
            $photo=base64_encode(Storage::disk('uploads')->get('photo/'.$user->photo));
        }else{
            // $photo=base64_encode(Storage::disk('uploads')->get('photo/No_image_available.svg'));
            $photo='';
        }
        if(Storage::disk('uploads')->exists('signature/'.$user->sign)){
            $sign=base64_encode(Storage::disk('uploads')->get('signature/'.$user->sign));
        } else{
            // $sign=base64_encode(Storage::disk('uploads')->get('signature/No_image_available.svg'));
            $sign='';
        }
        


        $mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $html=\View::make('user.ApplicationPrint.Report',compact('previewData','userData','qualification',
        'experience','photo','sign','appliedjob','documentData'));
        $html=$html->render();
        $mpdf->SetHTMLFooter('<table style="width:100%;font-size:12px;border-top:0.5px solid #000;"><tr><td style="text-align:left;">'.Carbon::now()->format('d-m-Y h:i:s').'</td><td style="text-align:right;">{PAGENO}</td></tr></table>');
        $mpdf->WriteHTML($html);
        $mpdf->output('Application.pdf','D');
    }
    

}
