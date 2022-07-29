<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReservationRequest extends FormRequest
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
        $nri   = 'NO' === $this->get('nriq');
        $nation = 'INDIAN' === $this->get('nation');
        $domicile = 'YES' === $this->get('domicle_maharashtra');
        $category = 'OPEN'  === $this->get('cate');

        $domicile_annual = 'YES'||'NO' === $this->get('domicle_maharashtra');
        $category_annual = 'OPEN'||'SC'||'ST'||'DT-VJ(A)'||'NT(B)'||'NT(C)'||'NT(D)'||'SBC'||'OBC'||'EWS' === $this->get('cate');

        $ews_category = 'EWS'  === $this->get('cate');
        $ews_cert_status_available = 'AVAILABLE' === $this->get('ews_cert_status');
        $ews_cert_status_applied = 'APPLIED BUT NOT RECEIVED' === $this->get('ews_cert_status');

        $rules = [
            'nriq'          => 'required',
            'nrim'          => 'required_if:nriq,YES',
            'nriw'          => 'required_if:nriq,YES',
            'nation'        => 'required|prohibited_if:nation,FOREIGNER',

            'domicle_maharashtra' => ($nri && $nation) ? $rules['domicle_maharashtra'] = 'required' : '',
            'cate'          => 'required_if:nation,INDIAN,FOREIGNER',
            'annual_family_income' => ($nri && $nation && $domicile_annual && $category_annual) ? $rules['annual_family_income'] = 'required' : '',

            'region_of_residence' => ($nri && $nation && $domicile_annual && $category_annual) ? $rules['region_of_residence'] = 'required' : '',

            'ews_cert_status' => 'required_if:cate,EWS',
            'ews_cert_no' => ($ews_category && $ews_cert_status_available) ? $rules['ews_cert_no'] = 'required' : '',
            'ews_cert_issue_dist' => ($ews_category && $ews_cert_status_available) ? $rules['ews_cert_issue_dist'] = 'required' : '',
            'ews_cert_appli_no' => ($ews_category && $ews_cert_status_applied) ? $rules['ews_cert_appli_no'] = 'required' : '',
            'ews_cert_appli_date' => ($ews_category && $ews_cert_status_applied) ? $rules['ews_cert_appli_date'] = 'required' : '',
            'ews_cert_appli_issue_dist' => ($ews_category && $ews_cert_status_applied) ? $rules['ews_cert_appli_issue_dist'] = 'required' : '',
            'ews_cert_appli_issue_taluka' => ($ews_category && $ews_cert_status_applied) ? $rules['ews_cert_appli_issue_taluka'] = 'required' : '',

            'caste_certificate' => 'required_if:cate,SC,ST,DT-VJ(A),NT(B),NT(D),SBC,OBC',
            'caste_cert_no' => 'required_if:caste_certificate,AVAILABLE',
            'caste_cert_issue_district' => 'required_if:caste_certificate,AVAILABLE',

            'caste_cert_appli_no' => 'required_if:caste_certificate,APPLIED BUT NOT RECEIVED',
            'caste_cert_appli_date' => 'required_if:caste_certificate,APPLIED BUT NOT RECEIVED',
            'caste_cert_appli_issue_dist' => 'required_if:caste_certificate,APPLIED BUT NOT RECEIVED',
            'caste_cert_appli_issue_taluka' => 'required_if:caste_certificate,APPLIED BUT NOT RECEIVED',

            'caste_validity'  =>  'required_if:caste_certificate,AVAILABLE',
            'caste_validity_no'  =>  'required_if:caste_validity,AVAILABLE',
            'caste_validity_issue_district'  =>  'required_if:caste_validity,AVAILABLE',

            'caste_validity_appli_no'  =>  'required_if:caste_validity,APPLIED BUT NOT RECEIVED',
            'caste_validity_appli_date'  =>  'required_if:caste_validity,APPLIED BUT NOT RECEIVED',
            'caste_validity_appli_issue_dist'  =>  'required_if:caste_validity,APPLIED BUT NOT RECEIVED',
            'caste_validity_appli_issue_taluka'  =>  'required_if:caste_validity,APPLIED BUT NOT RECEIVED',

            'ncl_cert' => 'required_if:cate,DT-VJ(A),NT(B),NT(D),SBC,OBC',
            'ncl_cert_no' => 'required_if:ncl_cert,AVAILABLE',
            'ncl_cert_issue_dist' => 'required_if:ncl_cert,AVAILABLE',
            'ncl_cert_date' => 'nullable|required_if:ncl_cert,AVAILABLE|date_format:'.config('panel.date_format').'|before_or_equal:'.config('datevalidation.reservation.ncl'),

            'ncl_cert_appli_no' => 'required_if:ncl_cert,APPLIED BUT NOT RECEIVED',
            'ncl_cert_appli_date' => 'required_if:ncl_cert,APPLIED BUT NOT RECEIVED',
            'ncl_cert_appli_issue_dist' => 'required_if:ncl_cert,APPLIED BUT NOT RECEIVED',
            'ncl_cert_appli_issue_taluka' => 'required_if:ncl_cert,APPLIED BUT NOT RECEIVED',

            'ph' => 'required',
            'orphan' => 'required',
            'minority' => 'required',
            'minority_quota' => 'required_if:minority,YES',
        ];

        return $rules;
    }
    public function messages()
    {
        return [

            'nriw.required_if' => 'Please select NRI Candidate ward',
            
            'nriq.required' => 'Please select NRI Candidate status',
            'nrim.required_if' => 'Please select NRI Candidate himself/herself',
            'nation.required' => 'Please select nationality of the candidate',
            'nation.prohibited_if'=> 'FOREIGNER candidates not allowed',

            'domicle_maharashtra.required' => 'Please select the domicile of maharashtra',
            'cate.required_if' => 'Please select category',
            'annual_family_income.required' => 'Please select the annual family income',

            'ews.required' => 'Please select EWS',
            'ews_cert_status.required' => 'Please Select EWS Certificate Status',
            'ews_cert_no.required' => 'Please Select EWS Certificate no',
            'ews_cert_issue_dist.required' => 'Please Select EWS Certificate Issuing District',
            'ews_cert_appli_no.required' => 'Please Select EWS Certificate Application no',
            'ews_cert_appli_date.required' => 'Please Select EWS Certificate Application Date',
            'ews_cert_appli_issue_dist.required' => 'Please Select EWS Certificate Application District',
            'ews_cert_appli_issue_taluka.required' => 'Please Select EWS Certificate Application Taluka',

            'caste_certificate.required_if' => 'Please select Caste Certificate',
            'caste_cert_no.required_if' => 'Please provide Caste Certificate Number',
            'caste_cert_issue_district.required_if' => 'Please provide Caste Certificate Inssuing District',

            'caste_cert_appli_no.required_if' => 'Please provide Caste Certificate Application no',
            'caste_cert_appli_date.required_if' => 'Please select Caste Certificate Application Date',
            'caste_cert_appli_issue_dist.required_if' => 'Please select Caste Certificate Application District',
            'caste_cert_appli_issue_taluka.required_if' => 'Please select Caste Certificate Application Taluka',


            'caste_validity_appli_no.required_if' => 'Please enter Caste Validity Application no',
            'caste_validity_appli_date.required_if' => 'Please select Caste Validity Application Date',
            'caste_validity_appli_issue_dist.required_if' => 'Please select Caste Validity Application District',
            'caste_validity_appli_issue_taluka.required_if' => 'Please select Caste Validity Application Taluka',

            'ncl_cert.required_if' => 'Please select NCL',
            'ncl_cert_no.required_if' => 'Please select NCL Certificate Number',
            'ncl_cert_issue_dist.required_if' => 'Please select NCL Certificate Inssuing District',
            'ncl_cert_date.required_if' => 'Please select NCL Certificate Date',
            'ncl_cert_date.date_format' =>"Please select valid NCL Certificate Date",
            'ncl_cert_date.before_or_equal' =>"Please select NCL Certificate Date before or equal to".config('datevalidation.reservation.ncl'),

            'ncl_cert_appli_no.required_if' => 'Please select NCL Certificate Application no',
            'ncl_cert_appli_date.required_if' => 'Please select NCL Certificate Application Date',
            'ncl_cert_appli_issue_dist.required_if' => 'Please select NCL Certificate Application District',
            'ncl_cert_appli_issue_taluka.required_if' => 'Please select NCL Certificate Application Taluka',

            'ph.required' => 'Please select Person With Disability',
            'orphan.required' => 'Please select candidate an orphan',
            'minority.required' => 'Please select minority Quota',
            'minority_quota.required' => 'Please select minority Quota Religion',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
