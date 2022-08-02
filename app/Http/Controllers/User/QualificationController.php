<?php

namespace App\Http\Controllers\user;

use Exception;
use App\Models\lookup;
use Illuminate\Http\Request;
use App\Models\QualificationType;
use App\Models\UserQualification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\User\UserQualificationRequest;
use App\Http\Controllers\Location\LocationController;
use Response;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        // abort_if(Gate::denies('qualification'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
        $qualification = QualificationType::Select('qualification_type_name','qualification_type_code')->orderby('sort_order','ASC')->get();
        $stateData = LocationController::getState();
        $grade = lookup::select('id','label')->where('type','LIKE','%qualification_grade%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();
        $mode = lookup::Select('id','label')->where('type','LIKE','%qualification_mode%')->orderby('label','ASC')->pluck('label','id')->prepend('[SELECT]','')->all();

        // user qualification
        $user_qualification = UserQualification::Select('user_qualification.id','user_qualification.typeResult','user_qualification.doq','user_qualification.attempts','user_qualification.percentage','user_qualification.courseDurations','user_qualification.compulsorySubjects','user_qualification.optionalSubjects','subject.subject_name as subject_name','university.name as university_name','class.label as class',
        'mode.label as mode','qualificationtype.qualification_type_name as qualification_type','qualificationname.qualification_name as qualification_name')
        ->leftjoin('qualificationtype','user_qualification.qualificationtype','=','qualificationtype.qualification_type_code')
        ->leftjoin('qualificationname','user_qualification.qualificationname','=','qualificationname.qualification_name_code')
        ->leftjoin('subject','user_qualification.subject','=','subject.subject_id')
        ->leftjoin('university','user_qualification.university','=','university.id')
        ->leftjoin('lookup_options as class','user_qualification.classGrade','=','class.id')
        ->leftjoin('lookup_options as mode','user_qualification.mode','=','mode.id')
        ->get();
          
        return view('user.ApplicationForm.qualification',compact('qualification','stateData','grade','mode','user_qualification'));
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
        
        try {
            $user=Auth::user();
            $data = $request->except('token');
            $data['user_id'] = $user->id;
            
            $insert = UserQualification::create($data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
