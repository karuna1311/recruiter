<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InserviceQuotaRequest extends FormRequest
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
            'inservice_quota'=> 'required',
            'inservice_establishment'=>'required_if:inservice_quota,YES',
            'inservice_join_date'=> 'required_if:inservice_quota,YES',
            'inservice_posting_addr' => 'required_if:inservice_quota,YES',
            'inservice_establish_noc'=> 'required_if:inservice_quota,YES',
            'inservice_establish_noc_date'=> 'nullable|required_if:inservice_establish_noc,YES|date_format:'.config('panel.date_format').'|before_or_equal:'.config('datevalidation.inservice_quota.noc'),
            'inservice_dept_enquiry'=> 'required_if:inservice_quota,YES',
            'inservice_dept_enquiry_details'=>'required_if:inservice_dept_enquiry,YES',
        ];
    }

    public function messages()
    {
        return [
            'inservice_quota.required' =>"Please select Inservice Quota",
            'inservice_jion_date.required_if' =>"Please select Date of Joining Permanent Service",
            'inservice_posting_addr.required_if' =>"Please enter Posting address of the Permanent Service",
            'inservice_establish_noc.required_if' =>"Please select NOC from respective Establishment",
            'inservice_establish_noc_date.required_if' =>"Please select Noc Issuing Date",
            'inservice_establish_noc_date.date_format' =>"Please select valid Noc Issuing Date",
            'inservice_establish_noc_date.before_or_equal' =>"Please select Noc Issuing Date before or equal to".config('datevalidation.inservice_quota.noc'),
            'inservice_dept_enquiry.required_if' =>"Please enter Departmental Enquiry is initiated/Pending",
            'inservice_dept_enquiry_details.required_if' =>"Please enter Departmental Enquiry details",
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
