<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserQualificationRequest extends FormRequest
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
            'qualificationtype' =>'required|string',
            'qualificationname' =>'required|string',
            // 'subject' =>'required|integer',
            'state' =>'required|integer',
            'university' =>'required|integer',
            'typeResult' =>'required|string',
            'doq' =>'required_if:typeResult,PASSED',
            'attempts' =>'required_if:typeResult,PASSED',
            'percentage' =>'required_if:typeResult,PASSED',            
            'classGrade' =>'required_if:typeResult,PASSED',
            'mode' =>'required_if:typeResult,PASSED',
            // 'compulsorySubjects' => 'sometimes|alpha_spaces',
            // 'optionalSubjects' => 'sometimes|alpha_spaces'
        ];
    }

    public function messages()
    {
        return [
            'qualificationtype.required'=>'Please select Qualification Type',
            'qualificationname.required'=>'Please select Qualification Name',
            'state.required'=>'Please select State',
            'university.required'=>'Please select University',
            'typeResult.required'=>'Please select Type Result',
            'classGrade.required'=>'Please select Class/Grade',
            'mode.required'=>'Please select Mode'
           
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
