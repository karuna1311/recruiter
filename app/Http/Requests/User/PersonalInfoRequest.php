<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PersonalInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cname_change' =>'required',
            'cname_change_value' =>'required_if:cname_change,Yes',
            'fname'=>'required|string|regex:/^([a-z\(\)]+)$/i',
            'mname'=>'required',
            'gender'=>'required',
            'alternate_mobile'=>'sometimes',
            'adhar_card_no'=> 'nullable|regex:/\b\d{12}\b/',
            'address_not_same'=>'sometimes',
            'bankemp' => 'required',
            'marathispeaking' => 'required',
            'permanent_address_1'=>'required',
            'permanent_address_2'=>'required',
            'permanent_address_3' =>'required',
            'permanent_state' =>'required',
            'permanent_city'=>'required',
            'permanent_district'=>'required',
            'permanent_taluka' =>'required',
            'permanent_pin_code'=>'required|regex:/\b\d{6}\b/',
            'present_address_1'=>'required_if:address_not_same,1',
            'present_address_2'=>'required_if:address_not_same,1',
            'present_address_3' =>'required_if:address_not_same,1',
            'present_state' =>'required_if:address_not_same,1',
            'present_city'=>'required_if:address_not_same,1',
            'present_district'=>'required_if:address_not_same,1',
            'present_taluka' =>'required_if:address_not_same,1',
            'present_pin_code'=>'required_if:address_not_same,1',
        ];
    }
    

    public function messages()
    {
        return [
            'cname_change.required'=>'Wheather your name is changed or updated after 10th or equilent qualification or after marriage?',
            'cname_change.required_if'=>'Please enter changed name',
            'fname.required'     =>  'The Father name is required',
            'fname.string'     =>  'Father name must not contain Special Character and number',
            'fname.regex'     =>  'Father name must not contain Special Character and number',
            'mname.required'     =>  'The Mother name is required',
            'gender.required'     =>  'Gender is required',
            'adhar_card_no.required'     =>  'Aadhar card no is required',
            'adhar_card_no.regex'     =>  'Please enter valid Aadhar card no ',
            'bankemp.required'     =>  'Are you employee with Municipal Co-Op Bank?',
            'marathispeaking.required'     =>  'Please Select Marathi Speaking',
            'permanent_address_1.required'     =>  'Permanent Address Line 1 is required',
            'permanent_address_2.required'     =>  'Permanent Address Line 2 is required',
            'permanent_address_3.required'     =>  'Permanent Address Line 3 is required',
            'permanent_state.required'     =>  'Permanent State is required',
            'permanent_city.required'     =>  'Permanent City is required',
            'permanent_district.required'     =>  'Permanent District is required',
            'permanent_taluka.required'     =>  'Permanent Taluka is required',
            'permanent_pin_code.required'     =>  'Permanent Pincode is required',
            'permanent_pin_code.regex'     =>  'Please enter valid Permanent Pincode',            
            'present_address_1.required_if'     =>  'present Address Line 1 is required',
            'present_address_2.required_if'     =>  'present Address Line 2 is required',
            'present_address_3.required_if'     =>  'present Address Line 3 is required',
            'present_state.required_if'     =>  'present State is required',
            'present_city.required_if'     =>  'present City is required',
            'present_district.required_if'     =>  'present District is required',
            'present_taluka.required_if'     =>  'present Taluka is required',
            'present_pin_code.required_if'     =>  'present Pincode is required',
            'present_pin_code.regex'     =>  'Please enter valid present Pincode',

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
