<?php

namespace App\Http\Controllers\user;

use Response;
use Gate;
use Exception;
use App\Models\User;
use App\Models\lookup;
use App\Models\subject;
use App\Models\university;
use Illuminate\Http\Request;
use App\Models\QualificationName;
use App\Models\QualificationType;
use App\Models\UserQualification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserQualificationRequest;
use App\Http\Controllers\Location\LocationController;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        abort_if(Gate::denies('qualification'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        
        $user_id =Auth::user()->id;
        
        $qualification = QualificationType::Select('qualification_type_name','qualification_type_code')->orderby('sort_order','ASC')->get();
    
        $stateData = LocationController::getState();
        $grade = lookup::select('id','label')->where('type','LIKE','%qualification_grade%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
        $mode = lookup::Select('id','label')->where('type','LIKE','%qualification_mode%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
        
        $user_qualification = UserQualification::Select('user_qualification.id','user_qualification.typeResult','user_qualification.doq',
        'user_qualification.attempts','user_qualification.percentage','user_qualification.compulsorySubjects',
        'user_qualification.optionalSubjects','subject.subject_name as subject_name','university.name as university_name','class.label as class',
        'mode.label as mode','qualificationtype.qualification_type_name as qualification_type','qualificationname.qualification_name as qualification_name')
        ->leftjoin('qualificationtype','user_qualification.qualificationtype','=','qualificationtype.qualification_type_code')
        ->leftjoin('qualificationname','user_qualification.qualificationname','=','qualificationname.qualification_name_code')
        ->leftjoin('subject','user_qualification.subject','=','subject.id')
        ->leftjoin('university','user_qualification.university','=','university.id')
        ->leftjoin('lookup_options as class','user_qualification.classGrade','=','class.id')
        ->leftjoin('lookup_options as mode','user_qualification.mode','=','mode.id')
        ->where('user_id',$user_id)
        ->orderBy('qualificationtype.sort_order','ASC')
        ->get();
        
        return view('user.ApplicationForm.Qualification',compact('qualification','stateData','grade','mode','user_qualification'));
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
    public function store(UserQualificationRequest $request)
    {
     
        try 
        {
            $user=Auth::user();
            $qualificationexists = UserQualification::exists();
            if($user->status_lock == '0'){

                $data = $request->except('token');
                $data['user_id'] = $user->id;
                
                $insert = UserQualification::create($data);
                if(!$qualificationexists){
                    User::where('id',$user->id)->update(['application_status'=>'3']);
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
        // abort_if(Gate::denies('login_edit'), response()->json(['status' => 'error','url'=> route('admin.login-instruction.index'),'data' => 'You don`t have permission to Edit']));
        $token = base64_decode($id);
        $data = UserQualification::find($token);
        $qualification_type_list = QualificationType::Select('qualification_type_name','qualification_type_code')->orderby('sort_order','ASC')->pluck('qualification_type_name','qualification_type_code')->prepend('select','')->all();
       
        $qualification_name_list = QualificationName::where('qualification_type_code','LIKE','%'.$data->qualificationtype.'%')
        ->orderBy('sort_order','ASC')->pluck('qualification_name_code','qualification_name')->prepend('[SELECT]','')->all();

        $university_list = university::where('state_id','=',$data->state)
        ->orderBy('name','ASC')->pluck('name','id')->prepend('[SELECT]','')->all();

        $state_list = LocationController::getState();
        $grade_list = lookup::select('id','label')->where('type','LIKE','%qualification_grade%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
        $mode_list = lookup::Select('id','label')->where('type','LIKE','%qualification_mode%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
        $subject_list = subject::select('subject.subject_name','subject.id')->where('qualification_name_code','like','%'.$data->qualificationname.'%')
        ->orderBy('subject_name','ASC')
        ->pluck('subject.subject_name','subject.id')->prepend('[Select]','')->toArray();
        
        $html_view = view('user.ApplicationForm.Modal.QualificationModal',compact('data','qualification_type_list','state_list',
        'grade_list','mode_list','subject_list','qualification_name_list','university_list'))->render();

        return response()->json(['html'=>$html_view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserQualificationRequest $request, $token)
    {        
        try 
        {  
            $user=Auth::user();
            if($user->status_lock == '0')
            {
                $id = base64_decode($token);
                $update = UserQualification::where('id',$id)->update($request->except('_token','_method'));

            }else if($user->status_lock =='1'){
                return Response::json(['status'=>'error','data'=>'Your account is locked, please first unlocked it.']);    
            }              
        }
        catch(Exception $e) {
            return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }
        return Response::json(['status'=>'success','data'=>'Data updated successfully']);
    }

    public function checkQualification(Request $request){      
        try {            
            $user=Auth::user();
            $check = UserQualification::exists();
            if($user->status_lock == '0')
            {                
            
                    if($check == true){
                        // User::where('id',$user->id)->update(['application_status'=>'3']);
                        return redirect()->route('experience.index');
                    }else{
                        return redirect()->route('qualification.index')->with('msg_error','Please add minimum 1 Qualification');
                    }
             
            }else if($user->status_lock =='1')
            {
                if($check == true){
                    return redirect()->route('experience.index');
                }
                    return redirect()->route('qualification.index')->with('msg_error','Your account is locked, please first unlocked it.');                
            }            
        }
        catch(Exception $e) {
            return redirect()->route('qualification.index')->with('msg_error',$e->getMessage());
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
        try
        {
            $qualification_id = base64_decode($id);
            $model = UserQualification::find($qualification_id);
            
            if(!empty($model)){
                $model->delete();
                return redirect()->route('qualification.index');
            }else{
                return redirect()->route('qualification.index')->with('error','Server Error');
            }

        }catch(Exception $e){
            return back()->with('msg_error' ,$e->getmessage());
        }
    }
}
