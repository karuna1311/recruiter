<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SecurityDepositeRequest;
use Illuminate\Http\Request;
use App\Models\MasterPgd;
use App\Models\User;
use Auth;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Response;
use Exception;
use Gate;
use SecurityDeposite;

class SecurityDepositeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('security_deposite'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $securityDepositeData=MasterPgd::select('id','security_deposite_seat_type','security_deposite_amount','nriq')->first();
        return view('user.ApplicationForm.SecurityDeposite',compact('securityDepositeData'));
    }
    public function update(SecurityDepositeRequest $request, MasterPgd $securityDeposite)
    {
        $updateData=$request->validated();
        try {
            $updateData['security_deposite_amount']=SecurityDeposite::getAmount($securityDeposite->nriq,$request->security_deposite_seat_type,$securityDeposite->cate);
            $updatetSequirityDeposite = $securityDeposite->update($updateData);
            $user=Auth::user();
            if($user->application_status < 6) User::where('id',$user->id)->update(['application_status'=>'6']);
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data submitted successfully']);
    }
    public function getSecurityDeposite(Request $request)
    {
        //echo $request->seatType;die();
        $securityDepositeData=MasterPgd::select('nriq','cate')->first();
        $amount=SecurityDeposite::getAmount($securityDepositeData->nriq,$request->seatType,$securityDepositeData->cate);
        return Response::json(['status'=>'success','data'=>$amount]);
    }
}
