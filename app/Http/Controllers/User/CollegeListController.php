<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\pincodedata;
use Illuminate\Http\Request;
use App\Http\Requests\User\LocationRequest;
use Response;

class CollegeListController extends Controller
{
    public function index($collegeType)
    {
        $govClgArry=array();
        $arryOfcollege=array();
        if($collegeType=='GOVERNMENT') $arryOfcollege=config('collegeinfo.GOVERNMENT_CLG');
        elseif($collegeType=='PRIVATE') $arryOfcollege=config('collegeinfo.PRIVATE_CLG');
        else $govClgArry['']='[SELECT]';
        foreach($arryOfcollege as $collegeName){
            $govClgArry[$collegeName]=$collegeName;
        }
       return Response::json(['collegeData'=>$govClgArry]);
    }
}
