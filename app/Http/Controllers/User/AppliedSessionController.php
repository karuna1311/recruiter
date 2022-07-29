<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DocumentUploadService;
use App\Models\MasterPgd;
use App\Models\SessionMaster;
use App\Models\Payment;
use Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Gate;

class AppliedSessionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('applied_session'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
    	$masterData=MasterPgd::select('session_master_id')->first();
    	$sessionData=SessionMaster::where('id',$masterData->session_master_id)->select('id','session_name')->first();
        return view('user.AppliedSession.index',compact('sessionData'));
    }
    public function applicationReport($sessionId){
    	$previewData=MasterPgd::where('session_master_id',$sessionId)->first(); 
        $documentData=DocumentUploadService::getDocumentList($previewData);
        $user=Auth::user();
        $userData = ['name'=>$user->name,'mobile'=>$user->mobile,'email'=>$user->email,'dob'=>$user->dob,'rollno'=>$user->rollno,'neetappno'=>$user->neetappno,'arank'=>$user->arank,'neet_marks'=>$user->neet_marks];
        $mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $html=\View::make('user.ApplicationPrint.Report',compact('previewData','userData','documentData'));
        $html=$html->render();
        $mpdf->SetHTMLFooter('<table style="width:100%;font-size:12px;border-top:0.5px solid #000;"><tr><td style="text-align:left;">'.Carbon::now()->format('d-m-Y h:i:s').'</td><td style="text-align:right;">{PAGENO}</td></tr></table>');
        $mpdf->WriteHTML($html);
        $mpdf->output('Application.pdf','D');
    }
    public function paymentReceipt(SessionMaster $session){
        $user=Auth::user();
        $paymentData=Payment::where([['user_id',$user->id],['session_master_id',$session->id]])->first();
        $userData = ['name'=>$user->name,'mobile'=>$user->mobile,'email'=>$user->email,'dob'=>$user->dob,'rollno'=>$user->rollno,'neetappno'=>$user->neetappno];
        $mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $html=\View::make('user.Payment.receipt',compact('session','userData','paymentData'));
        $html=$html->render();
        $mpdf->SetHTMLFooter('<table style="width:100%;font-size:12px;border-top:0.5px solid #000;"><tr><td style="text-align:left;">'.Carbon::now()->format('d-m-Y h:i:s').'</td><td style="text-align:right;">{PAGENO}</td></tr></table>');
        $mpdf->WriteHTML($html);
        $mpdf->output('PaymentReceipt.pdf','D');
    }
    public function zzzz(){
    	$data['title']="Print Report";
        $pdf = mb_convert_encoding(\View::make('user.ApplicationPrint.Report',compact('previewData','userData')), 'HTML-ENTITIES', 'UTF-8');
        return PDF::loadHtml($pdf)->download('invoice.pdf');
    }
}
