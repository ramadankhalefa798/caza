<?php

namespace App\Http\Requests\Company;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use GeneralTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:20',
            'country_code' => 'required',
            'phone' => 'required|unique:companies,phone',
            'adjective_id' => 'required|exists:adjectives,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        $this->returnFormRequestError($error);
    }
}
