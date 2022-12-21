<?php

namespace App\Services;
use Storage;
class InstructionsService 
{
    public static function parseInstructions($intructionFor)
    {
        switch($intructionFor){
            case 'registration':
               return self::getRegisterInstruction();
                break;
            case 'login': 
                return self::getLoginInstruction();
            default:
                $fileName='';
                break;
        }
    }
    public static function getRegisterInstruction(){
        $instructionArray=json_decode(Storage::disk('uploads')->get('/Instructions/json/RegistrationInstructions.json'),true);
        foreach($instructionArray as $key => $instructions){
            if(count($instructions['children'])){
                $children=$instructions['children'];

                usort($children, function($a, $b) {
                    return $a['orderId'] <=> $b['orderId'];
                });
                $instructionArray[$key]['children']=$children;
            }
        }
        usort($instructionArray, function($a, $b) {
            return $a['orderId'] <=> $b['orderId'];
        });
        return $instructionArray;
    }
    public static function getLoginInstruction(){
        
        $instructionArray=json_decode(Storage::disk('uploads')->get('/Instructions/json/LoginInstructions.json'),true);
        foreach($instructionArray as $key => $instructions){
            if($instructions['id']=='1'){
                $notficationArr=$instructionArray[$key];
                unset($instructionArray[$key]);
                continue;
            }
            if($instructions['isActive']!='1') {
                unset($instructionArray[$key]);
                continue;
            }
            (count($instructions['children'])) ? $instructionArray[$key]['children']='1': $instructionArray[$key]['children']='0';
        }
        usort($instructionArray, function($a, $b) {
            return $a['orderId'] <=> $b['orderId'];
        });
        usort($notficationArr['children'], function($a, $b) {
            return $a['orderId'] <=> $b['orderId'];
        });
        
        return ['news'=>$instructionArray,'notification'=>$notficationArr['children']];
    }
    public static function getLoginInstructionById($id){
        
        $instructionArray=json_decode(Storage::disk('uploads')->get('Instructions/json/LoginInstructions.json'),true);
        $childrenArray=array();
        foreach($instructionArray as $value){  
            if($value['id']==$id){
                $childrenArray=$value['children'];
                break;
            }
        }
        if(count($childrenArray)){
                usort($childrenArray, function($a, $b) {
                return $a['orderId'] <=> $b['orderId'];
            });
        }
        return $childrenArray;
    }
}
