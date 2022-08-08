<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\QualificationName;
use App\Models\subject;
use App\Models\university;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    

    public static function getQualificationName($type){
     
        $token = base64_decode(filter_var($type));
        return QualificationName::where('qualification_type_code','LIKE','%'.$token.'%')
        ->orderBy('sort_order','ASC')->pluck('qualification_name_code','qualification_name')->prepend('[SELECT]','')->all();
    }

    public function getUniversity($id){
        $token = base64_decode(filter_var($id));
    
        return university::where('state_id','=',$token)
        ->orderBy('name','ASC')->pluck('name','id')->prepend('[SELECT]','')->all();
    } 
    
    public function getSubject($id){
        $token = base64_decode(filter_var($id));
    
        return subject::select('subject.subject_name','subject.id')->where('qualification_name_code','like','%'.$token.'%')
        ->orderBy('subject_name','ASC')
        ->pluck('subject.subject_name','subject.id')->prepend('[Select]','')->toArray();
        
    }


}
