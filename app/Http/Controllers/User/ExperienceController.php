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
        return view('user.ApplicationForm.experience',compact('post_name','job_nature','appointment_nature'));
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
