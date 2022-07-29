<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MedicalCouncilRequest extends FormRequest
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
            'medical_council_reg' => 'required',
            'medical_council_reg_no' => 'required_if:medical_council_reg,YES,APPLIED',
            'medical_dci_reg' => 'required',
            'medical_dci_reg_no' => 'required_if:medical_dci_reg,YES',
        ];
    }

    public function messages()
    {
        return [
            'medical_council_reg.required' => 'Medical Council Registration is required',
            'medical_council_reg_no.required_if' => 'Medical Council Registration No is required',
            'medical_dci_reg.required' => 'Medical DCI Registration is required',
            'medical_dci_reg_no.required_if' => 'Medical DCI Registration No is required',

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }

}
