<?php
namespace App\Http\Requests\User;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use GeneralTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_code' => 'required',
            'phone' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        $this->returnFormRequestError($error);
    }
}
