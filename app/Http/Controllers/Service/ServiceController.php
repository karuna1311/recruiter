<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\QualificationName;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    

    public static function getQualificationName($type){
        $value = filter_var($type);
        return QualificationName::where('qualificationtypecode','LIKE','%'.$value.'%')
        ->orderBy('sort_order','ASC')->pluck('qualificationnamecode','qualificationname')->prepend('[SELECT]','')->all();
    }
}
