<?php

namespace App\Http\Controllers\Location;
use Response;
use App\Models\state;
use App\Models\pincodedata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LocationRequest;
use App\Models\district;
use App\Models\taluka;
use App\Models\village;

class LocationController extends Controller
{
    public function index(LocationRequest $request)
    {
        $requiredEntity=$request->requiredEntity;
        switch ($requiredEntity) {
            case 'state':
                $data=$this->getState();
                break;
            case 'district':
                $data=$this->getDistrict($request->state);
                break;
            case 'subDistrict':
                $data=$this->getSubDistrict($request->district);
                break;
            case 'pincode':
                $data=$this->getPincode($request->subDistrict);
                break;            
            default:
                $data=[''=>'[SELECT]'];
                break;
        }  
       return Response::json(['locationData'=>$data]);

    }
    public static function getState(){
        return state::select('state_name','state_id')->orderBy('state_id')->pluck('state_name','state_id')->prepend('[SELECT]','')->all();
    }
    public static function getDistrict($state){
      
        if($state==null){
            return district::select('district_name','district_id')->pluck('district_name','district_id')->prepend('[SELECT]','')->all();
        }else{
            return district::where('state_id',$state)->select('district_name','district_id')->pluck('district_name','district_id')->prepend('[SELECT]','')->all();
        }
         
    }
    public static function getSubDistrict($district){
        if($district==null){
            return taluka::select('subdistrict_name','subdistrict_id')->pluck('subdistrict_name','subdistrict_id')->prepend('[SELECT]','')->all();
        }else{
            return taluka::where('district_id',$district)->select('subdistrict_name','subdistrict_id')->pluck('subdistrict_name','subdistrict_id')->prepend('[SELECT]','')->all();
        }
    }
    public static function getPincode($subDistrict){
       if($subDistrict==null){
           return village::select('pincode')->pluck('pincode','pincode')->prepend('[SELECT]','')->all();
       }else{
           return village::where('subdistrict_id',$subDistrict)->select('pincode')->pluck('pincode','pincode')->prepend('[SELECT]','')->all();
       }
    }
}
