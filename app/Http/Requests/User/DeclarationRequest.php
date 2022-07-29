<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeclarationRequest extends FormRequest
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
            'declare1' => 'required',
            'declare2' => 'required',
            'declare3' => 'required',
            'declare4' => 'required',
            'declare5' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'declare1.required' => 'Declaration is required',
            'declare2.required' => 'Declaration is required',
            'declare3.required' => 'Declaration is required',
            'declare4.required' => 'Declaration is required',
            'declare5.required' => 'Declaration is required',
        ];
       
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['ValidatorErrors' => $validator->errors()], 200));
    }
}
