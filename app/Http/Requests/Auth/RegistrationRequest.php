<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationRequest extends FormRequest
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
            'salutation' => 'required',
            'name' => 'required|string|min:3',
            'mother_name' => 'required|string|min:3|regex:/^[a-zA-Z\d]+$/',
            'dob' => 'required|date_format:'.config('panel.date_format').'|before:'.config('datevalidation.registration.dob'),
            'mobile' => 'required|regex:/\b\d{10}\b/|unique:users',
            'mobileOtp' => 'required|regex:/\b\d{6}\b/',
            'email' => 'required|email|unique:users',
            'EmailOtp' => 'required|regex:/\b\d{6}\b/',
            'encryptMobileOtp' => 'required',
            'encryptEmailOtp'=> 'required'
        ];
    }
    public function messages()
    {
        return [           
            'salutation.required' => 'Select Salutation',
            'name.required' => 'Name required',
            'mother_name.required' => 'Mother Name required',
            'dob.required' => 'Dob required',
            'dob.before' => 'Dob must be before 01-01-2001',
            'mobile.required' => 'Mobile no required',
            'email.required' => 'Email required',
            'encryptMobileOtp.required' => 'Mobile verification not completed',
            'encryptEmailOtp.required' => 'Email verification not completed',
        ];

    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
