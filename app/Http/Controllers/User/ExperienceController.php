<?php

namespace App\Http\Controllers\User;

use Response;
use Exception;
use App\Models\lookup;
use Illuminate\Http\Request;
use App\Models\UserExperience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserExperienceRequest;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_name = lookup::select('label','id')->where('type','LIKE','%post_name%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();       
        $job_nature = lookup::select('id','label')->where('type','LIKE','%job_nature%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
        $appointment_nature = lookup::select('id','label')->where('type','LIKE','%appointment_nature%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
       
        $user_experience = UserExperience::Select('user_experience.id as id','employmentType','flgMpscSelection','post.label as post_name','officeName',
        'flgOfficeGovOwned','designation','job_nature.label as job_nature','appointment.label as appointment','time','appointmentLetterNo',
        'letterDate','payScale','gradePay','basicPay','monthlyGrossSalary','fromDate','toDate','expYears','expMonths','expDays'
        )
        ->leftjoin('lookup_options as post','user_experience.postNameLookupId','=','post.id')
        ->leftjoin('lookup_options as job_nature','user_experience.jobNatureLookupId','=','job_nature.id')
        ->leftjoin('lookup_options as appointment','user_experience.apointmentNatureLookupId','=','appointment.id')
        ->get();
       
        return view('user.ApplicationForm.experience',compact('post_name','job_nature','appointment_nature','user_experience'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserExperienceRequest $request)
    {        
        try {
            $user=Auth::user();
            $data = $request->except('_token');
            $data['user_id'] = $user->id;
            
            $insert = UserExperience::create($data);
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data submitted successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // abort_if(Gate::denies('login_edit'), response()->json(['status' => 'error','url'=> route('admin.login-instruction.index'),'data' => 'You don`t have permission to Edit']));
         $token = base64_decode($id);
         $data = UserExperience::find($token);
         $post_name = lookup::select('label','id')->where('type','LIKE','%post_name%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();       
        $job_nature = lookup::select('id','label')->where('type','LIKE','%job_nature%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
        $appointment_nature = lookup::select('id','label')->where('type','LIKE','%appointment_nature%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
       
        $user_experience = UserExperience::Select('*')->get();
       
         $html_view = view('user.ApplicationForm.Modal.ExperienceModal',compact('data','user_experience','post_name',
         'job_nature',
         'appointment_nature'))->render();
 
 
         return response()->json(['html'=>$html_view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserExperienceRequest $request, $token)
    {
        try {            
            $id = base64_decode($token);
            $update = UserExperience::where('id',$id)->update($request->except('_token','_method'));
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
