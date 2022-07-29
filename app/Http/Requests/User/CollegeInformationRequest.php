<?php

namespace App\Http\Requests\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class CollegeInformationRequest extends FormRequest
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
        $aiiims =$this->get('mbbs_dc_in_mh_or_aiims');
        $collegeType =$this->get('mbbs_college_type');
        $rules = [
            'mbbs_passing_date' => 'required|date',
            'mbbs_agg_per' => 'required|numeric|between:50,100',
            'mbbs_internship_date' => 'required|date_format:'.config('panel.date_format').'|before_or_equal:'.config('datevalidation.college_info.internship_date'),
            'mci_reg_diploma' => 'required|string|prohibited_if:mci_reg_diploma,YES',
            'diploma_subject' => 'required_if:mci_reg_diploma,COMPLETED',
            'mci_reg_degree' => 'required|string|prohibited_if:mci_reg_degree,YES',
            'degree_subject' => 'required_if:mci_reg_degree,COMPLETED',
            'mbbs_dc_in_mh_or_aiims' => 'required|string',
            'mbbs_college_type' => 'required_if:mbbs_dc_in_mh_or_aiims,YES',
            'mbbs_college_name' => 'required_if:mbbs_college_type,GOVERNMENT,PRIVATE',
            'mbbs_college_outoff_ind_mah'=>'required_if:mbbs_dc_in_mh_or_aiims,NO|prohibited_if:mbbs_college_outoff_ind_mah,DENTAL COLLEGE OUT OF INDIA',
            'mbbs_college_ind_mah'=>(($aiiims==='YES' && $collegeType==='AIIMS OR CENTRAL GOVT INSTITUTION') || $aiiims==='NO') ? $rules['mbbs_college_ind_mah'] = 'required' : '',
            'mbbs_university_ind_mah'=>(($aiiims==='YES' && $collegeType==='AIIMS OR CENTRAL GOVT INSTITUTION') || $aiiims==='NO') ? $rules['mbbs_university_ind_mah'] = 'required' : '',
            'aiee' => 'required|string',
            'neet_pg_attempt_year' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required!',
            'mbbs_passing_date.required' => 'The Passing Date is required',
            'mbbs_agg_per.required' => 'Enter MBBS Aggregate Percentage',
            'mbbs_internship_date.required' => 'The internship date is required',
            'mbbs_internship_date.date_format' => 'The select valid internship date',
            'mbbs_internship_date.before_or_equal' => 'The select internship date before or equal to '.config('datevalidation.college_info.internship_date'),
            'mci_reg_diploma.required' => 'Select Wheather Completed the MCI Recognise Diploma',
            'mci_reg_diploma.prohibited_if' => 'PG Diploma Course Pursuing Candidates Are Not Eligible.',
            'mci_reg_degree.required' => 'Select MCI Reg Degree Subject / Course',
            'mbbs_dc_in_mh_or_aiims.required' => 'Select If MBBS is done from MH Or AIIMS',
            'mbbs_college_type.required' => 'Select MBBS College Type',
            'mbbs_college_name.required' => 'Enter MBBS College Name',
            'mbbs_college_outoff_ind_mah.required_if' => 'Please select MBBS College out of india or maharashtra',
            'mbbs_college_outoff_ind_mah.prohibited_if'=>'DENTAL COLLEGE OUT OF INDIA not eligible',
            'mbbs_college_ind_mah.required_if' => 'Enter MBBS College Name out of india or maharashtra',
            'mbbs_university_ind_mah.required_if' => 'Enter MBBS College University Name out of india or maharashtra',
            'aiee.required' => 'Please Select Whether the Candidate has passed MBBS Degree under 15% All India Quota/AIIMS/Central Govt. Institute',
            'bond_service.required' => 'Please Select If Candidate have Completed Bond Service',
            'bond_service_undertaking.required' => 'Check the Bond Service Undertaking',
            'neet_pg_attempt_year.required' => 'The NEET / PG  previous attempt year is required',
            'mbbs_agg_per.between' => 'The Aggregate Percentage should be between 50 and 100',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
