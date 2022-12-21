<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserExperienceRequest extends FormRequest
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
            'employmentType' => "required",            
            'officeName' => "required",
            'jobNatureLookupId' => "required",           
            'apointmentNatureLookupId' => "required",            
            'letterDate' => 'required_if:apointmentNatureLookupId,258',
            'fromDate' => "required|date|before_or_equal:today",
            'toDate' => 'required_if:employmentType,PAST|before_or_equal:today|after_or_equal:fromDate',
            'postNameLookupId' => 'required',
            'designation' => "required_if:postNameLookupId,433",
            'appointmentLetterNo' => 'required_if:apointmentNatureLookupId,269,258,272,271',
            'time' => 'required_if:apointmentNatureLookupId,269',          

        ];
    }

    public function messages()
    {
        return [
            'letterDate.before'=>'The Letter date must be a date before today. ',
            'toDate.before'=>'The To date must be a date before today. ',
            'designation.required_if'=>'Please Enter the designation , Which is not in the list ',
            'appointmentLetterNo.required_if' => 'Please enter Appointment Letter No'        
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
