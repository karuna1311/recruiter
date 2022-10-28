<?php

namespace App\Http\Controllers\User;
use App\Http\Requests\User\ReservationRequest;
use App\Models\UserReservation;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Location\LocationController;
use App\Models\lookup;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Response;
use Auth;
use Gate;

class ReservationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reservation'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $reservationData=UserReservation::select('id','nriq','nrim','nriw','nation','domicle_maharashtra','cate','caste_certificate','caste_cert_no','caste_cert_issue_district','caste_cert_appli_no','caste_cert_appli_date','caste_cert_appli_issue_dist','caste_cert_appli_issue_taluka','caste_validity','caste_validity_no','caste_validity_issue_district','caste_validity_appli_no','caste_validity_appli_date','caste_validity_appli_issue_dist','caste_validity_appli_issue_taluka',
        'ncl_cert','ncl_cert_no','ncl_cert_issue_dist','ncl_cert_date','ncl_cert_appli_no','ncl_cert_appli_date','ncl_cert_appli_issue_dist','ncl_cert_appli_issue_taluka',
        'annual_family_income','ews','ews_cert_status','ews_cert_no','ews_cert_issue_dist',
        'ews_cert_appli_no','ews_cert_appli_date','ews_cert_appli_issue_dist','ews_cert_appli_issue_taluka',
        'ph','ph_type',
        'per_disability',
        'orphan_type',
       'ex_serviceman',
       'forces_division',
       'join_date',
       'retirement_date',
       'service_period',
       'sports_person',
       'type_competition',
       'level_competition',
       'position_medal',
       'competition_year',
        'orphan','minority','minority_quota','region_of_residence')->first();
        $districtData = LocationController::getDistrict('27');
        $disability  = lookup::select('label','id')->where('type','LIKE','%disability_category%')->pluck('label','id')->prepend('[SELECT]','')->all();
        $competition_type = lookup::select('label','id')->where('type','LIKE','%competition_type%')->pluck('label','id')->prepend('[SELECT]','')->all();
        $position_medal = lookup::select('label','id')->where('type','LIKE','%position_medal%')->pluck('label','id')->prepend('[SELECT]','')->all();
        // dd($competition_type);
        return view('user.ApplicationForm.Reservation',compact('districtData','reservationData','disability','competition_type','position_medal'));
    }
    public function create()
    {
        //
    }
    public function store(ReservationRequest $request)
    {
     dd($request->all);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(ReservationRequest $request,UserReservation $reservation)
    {
        try {
            $user=Auth::user();

            if($request->nation == "INDIAN" && $user->status_lock == '0'){
                $updatetReservation = $reservation->update($request->all());
                if($user->application_status < 2) User::where('id',$user->id)->update(['application_status'=>'2']);
            }else if($user->status_lock =='1'){
                return Response::json(['status'=>'error','data'=>'Your account is locked, please first unlocked it.']);    
            }
            else{
                return Response::json(['status'=>'error','data'=>'FOREIGNER Candidate are not allowed']);    
            }
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data updated successfully']);
    }
    public function destroy($id)
    {
        //
    }
}
