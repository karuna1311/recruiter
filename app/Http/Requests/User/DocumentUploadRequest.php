<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DocumentUploadRequest extends FormRequest
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
            'documentFile'=> 'required|mimes:pdf|max:300',
            'documentTypeRequired'=> 'sometimes',
            'documentType'=> 'required_if:documentTypeRequired,1',
        ];
    }

    public function messages()
    {
        return [
            'documentFile.required' => 'File is required',
            'documentFile.mimes' => 'Only pdf format is allowed',
            'documentFile.max' => 'Maximum size of file must be 300KB',
            'documentType.required_if' => 'Please select document type',
        ];
    }
     protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
