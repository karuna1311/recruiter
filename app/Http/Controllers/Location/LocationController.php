<?php

namespace App\Http\Controllers\Location;
use Response;
use App\Models\state;
use App\Models\pincodedata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LocationRequest;

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
                $data=$this->getSubDistrict($request->state,$request->district);
                break;
            case 'pincode':
                $data=$this->getPincode($request->state,$request->district,$request->subDistrict);
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
    // public static function getDistrict($state){
    //     return pincodedata::where('statename',$state)->select('districtname')->groupBy('districtname')->orderBy('districtname')->pluck('districtname','districtname')->prepend('[SELECT]','')->all();
    // }
    // protected function getSubDistrict($statename,$district){
    //     return pincodedata::where([['statename',$statename],['districtname',$district]])->select('taluka')->groupBy('taluka')->orderBy('taluka')->pluck('taluka','taluka')->prepend('[SELECT]','')->all();
    // }
    // protected function getPincode($statename,$district,$subDistrict){
    //     return pincodedata::where([['statename',$statename],['districtname',$district],['taluka',$subDistrict]])->select('pincode')->groupBy('pincode')->orderBy('pincode')->pluck('pincode','pincode')->prepend('[SELECT]',' ')->all();
    // }
}
