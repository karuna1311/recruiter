<?php

namespace App\Http\Requests;

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
            'flgMpscSelection' => "required",
            'officeName' => "required",
            'flgOfficeGovOwned' => "required",
            'designation' => "required",
            'jobNatureLookupId' => "required",
            'flgGazettedPost' => "required",
            'apointmentNatureLookupId' => "required",
            'payScale' => "required",
            'gradePay' => "required",
            'basicPay' => "required",
            'monthlyGrossSalary' => "required",
            'fromDate' => "required",
            'toDate' => 'required_if:employmentType,PAST',
            'typeGroup' => 'required_if:flgGazettedPost,YES',
            'postNameLookupId' => 'required_if:flgMpscSelection,YES',
            'appointmentLetterNo' => 'required_if:apointmentNatureLookupId,269,258,272,271',
            'letterDate' => 'required_if:apointmentNatureLookupId,258',
            'time' => 'required_if:apointmentNatureLookupId,269',          

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
