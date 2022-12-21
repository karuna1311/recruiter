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
    
        $nation = 'INDIAN' === $this->get('nation');


        $domicile_annual = 'YES'||'NO' === $this->get('domicle_maharashtra');
        $category_annual = 'Unreserved'||'SC'||'ST'||'DT-A'||'NT-B'||'NT-C'||'NT-D'||'SBC'||'OBC'||'EWS' === $this->get('cate');

        $ews_category = 'EWS'  === $this->get('cate');
        $ews_cert_status_available = 'AVAILABLE' === $this->get('ews_cert_status');
        $ews_cert_status_applied = 'APPLIED BUT NOT RECEIVED' === $this->get('ews_cert_status');

        $rules = [
            'nation'        => 'required',
            'domicle_maharashtra' => ($nation) ? $rules['domicle_maharashtra'] = 'required' : '',
            'cate'          => 'required_if:nation,INDIAN',
            'annual_family_income' => ($nation && $domicile_annual && $category_annual) ? $rules['annual_family_income'] = 'required' : '',
            'region_of_residence' => ($nation && $domicile_annual && $category_annual) ? $rules['region_of_residence'] = 'required' : '',

            'ews_cert_status' => 'required_if:cate,EWS',
            'ews_cert_no' => ($ews_category && $ews_cert_status_available) ? $rules['ews_cert_no'] = 'required' : '',
            'ews_cert_issue_dist' => ($ews_category && $ews_cert_status_available) ? $rules['ews_cert_issue_dist'] = 'required' : '',
            'ews_cert_appli_no' => ($ews_category && $ews_cert_status_applied) ? $rules['ews_cert_appli_no'] = 'required' : '',
            'ews_cert_appli_date' => ($ews_category && $ews_cert_status_applied) ? $rules['ews_cert_appli_date'] = 'required' : '',
            'ews_cert_appli_issue_dist' => ($ews_category && $ews_cert_status_applied) ? $rules['ews_cert_appli_issue_dist'] = 'required' : '',
            'ews_cert_appli_issue_taluka' => ($ews_category && $ews_cert_status_applied) ? $rules['ews_cert_appli_issue_taluka'] = 'required' : '',

            'caste_certificate' => 'required_if:cate,SC,ST,DT-A,NT-B,NT-D,SBC,OBC',
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

            'ncl_cert' => 'required_if:cate,DT-A,NT-B,NT-D,SBC,OBC',
            'ncl_cert_no' => 'required_if:ncl_cert,AVAILABLE',
            'ncl_cert_issue_dist' => 'required_if:ncl_cert,AVAILABLE',
            'ncl_cert_date' => 'nullable|required_if:ncl_cert,AVAILABLE|date_format:'.config('panel.date_format').'|before_or_equal:'.config('datevalidation.reservation.ncl'),

            'ncl_cert_appli_no' => 'required_if:ncl_cert,APPLIED BUT NOT RECEIVED',
            'ncl_cert_appli_date' => 'required_if:ncl_cert,APPLIED BUT NOT RECEIVED',
            'ncl_cert_appli_issue_dist' => 'required_if:ncl_cert,APPLIED BUT NOT RECEIVED',
            'ncl_cert_appli_issue_taluka' => 'required_if:ncl_cert,APPLIED BUT NOT RECEIVED',
            
            'ph' => 'required',
            'per_disability' => 'required_if:ph,YES',
            'ph_type' => 'required_if:ph,YES',
            
            
            'orphan' => 'required',
            'orphan_type' => 'required_if:orphan,YES',
            
            'ex_serviceman' => 'required',
            'forces_division' => 'required_if:ex_serviceman,YES',
            'join_date' => 'required_if:ex_serviceman,YES',
            'retirement_date' => 'required_if:ex_serviceman,YES',
            'service_years' => 'required_if:ex_serviceman,YES',
            'service_months' => 'required_if:ex_serviceman,YES',
            'service_days' => 'required_if:ex_serviceman,YES',
            
            'sports_person' => 'required',
            'type_competition' => 'required_if:sports_person,YES',
            'level_competition' => 'required_if:sports_person,YES',
            'position_medal' => 'required_if:sports_person,YES',
            'competition_year' => 'required_if:sports_person,YES',
            
        ];

        return $rules;
    }
    public function messages()
    {
        return [

            'nation.required' => 'Please select nationality of the candidate',
        
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
