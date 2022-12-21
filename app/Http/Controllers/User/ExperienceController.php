<?php

namespace App\Http\Controllers\User;

use Response;
use Gate;
use Exception;
use App\Models\User;
use App\Models\lookup;
use Illuminate\Http\Request;
use App\Models\UserExperience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserExperienceRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('experience'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $user_id =Auth::user()->id;
        $post_name = lookup::select('label','id')->where('type','LIKE','%post_name%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();       
        $job_nature = lookup::select('id','label')->where('type','LIKE','%job_nature%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
        $appointment_nature = lookup::select('id','label')->where('type','LIKE','%appointment_nature%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
       
        $user_experience = UserExperience::Select('user_experience.id as id','employmentType','post.label as post_name','officeName'
        ,'designation','job_nature.label as job_nature','appointment.label as appointment','time','appointmentLetterNo',
        'letterDate','payScale','gradePay','basicPay','monthlyGrossSalary','fromDate','toDate','expYears','expMonths','expDays'
        )
        ->leftjoin('lookup_options as post','user_experience.postNameLookupId','=','post.id')
        ->leftjoin('lookup_options as job_nature','user_experience.jobNatureLookupId','=','job_nature.id')
        ->leftjoin('lookup_options as appointment','user_experience.apointmentNatureLookupId','=','appointment.id')
        ->where('user_id',$user_id)
        ->get();
    //    dd($user_experience);
        return view('user.ApplicationForm.Experience',compact('post_name','job_nature','appointment_nature','user_experience'));
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
        // dd($request->all());
        abort_if(Gate::denies('experience'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        
        try {
            $user=Auth::user();

            if($user->status_lock == '0'){
                $experienceexists = UserExperience::exists();
                $postname = $request->postNameLookupId;
                if($postname==433){

                    $sort_order_post = lookup::where('type','post_name')->select('sort_order')->orderBy('sort_order', 'desc')->first();

                    $incre_sort_order = intval($sort_order_post->sort_order) + 1;
                    

                  $insert_lookup =   lookup::create([
                        'module' => 'profile_creation',
                        'type' => 'post_name',
                        'parent_id' => 0,
                        'label' => $request->designation,
                        'sort_order' => $incre_sort_order
                    ]);
                    $lastId = $insert_lookup->id;
                    $data = $request->except('_token');
                    $data['postNameLookupId'] = $lastId;
                    $data['user_id'] = $user->id;
                   
                    $insert = UserExperience::create($data);
                    
                    if(!$experienceexists){
                        User::where('id',$user->id)->update(['application_status'=>'4']);
                    }
                }else{
                    $data = $request->except('_token');
                    
                    $data['user_id'] = $user->id;
               
                    $insert = UserExperience::create($data);
                    if(!$experienceexists){
                        User::where('id',$user->id)->update(['application_status'=>'4']);
                    }                    
                }
               
              
            }else if($user->status_lock =='1'){
                return Response::json(['status'=>'error','data'=>'Your account is locked, please first unlocked it.']);    
            }            

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
            
            $user=Auth::user();
                    if($user->status_lock == '0'){
                        $postname = $request->postNameLookupId;
                        if($postname==433){

                            $sort_order_post = lookup::where('type','post_name')->select('sort_order')->orderBy('sort_order', 'desc')->first();

                            $incre_sort_order = intval($sort_order_post->sort_order) + 1;
                            
                        $insert_lookup =   lookup::create([
                            'module' => 'profile_creation',
                            'type' => 'post_name',
                            'parent_id' => 0,
                            'label' => $request->designation,
                            'sort_order' => $incre_sort_order
                        ]);
                        $lastId = $insert_lookup->id;
                        $data = $request->except('_token','_method');
                        $data['postNameLookupId'] = $lastId;
                    

                        $id = base64_decode($token);                
                        $update = UserExperience::where('id',$id)->update($data);
                    }else{
                        $data = $request->except('_token','_method');
                        $id = base64_decode($token);                
                        $update = UserExperience::where('id',$id)->update($data);

                    }  
            }else if($user->status_lock =='1'){
                return Response::json(['status'=>'error','data'=>'Your account is locked, please first unlocked it.']);    
            }            

        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data updated successfully']);
    }

    public function checkExperience(){      
        abort_if(Gate::denies('experience'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        try {            
            $user=Auth::user();
            $check = UserExperience::exists();
            if($user->status_lock == '0'){                
            
                    if($check == true){
                        // User::where('id',$user->id)->update(['application_status'=>'4']);
                        return redirect()->route('postavailable.index');
                    }else{
                        return redirect()->route('experience.index')->with('msg_error','Please add minimum 1 Experience');
                    }             
            }else if($user->status_lock =='1'){
                
                if($check == true){                    
                    return redirect()->route('postavailable.index');
                }
                return redirect()->route('experience.index')->with('msg_error','Your account is locked, please first unlocked it.');
            }            
        }
        catch(Exception $e) {
            return redirect()->route('experience.index')->with('msg_error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function destroy($id)
    {
        
        try{
            $experience_id = base64_decode($id);
            $model = UserExperience::find($experience_id);
            
            if(!empty($model)){
                $model->delete();
                return redirect()->route('experience.index');
            }else{
                return redirect()->route('experience.index')->with('error','Server Error');
            }

        }catch(Exception $e){
            return back()->with('msg_error' ,$e->getmessage());
        }
    }
}
