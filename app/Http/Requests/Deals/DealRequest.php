<?php

namespace App\Http\Requests\Deals;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
{
    use GeneralTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_id' => 'required|exists:countries,id',
            'deal_type_id' => 'required|exists:deals_types,id',
            'estate_type_id' => 'required|exists:estates_types,id',
            'from_us' => 'required|in:0,1',
            'deal_value' => 'required|numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        $this->returnFormRequestError($error);
    }
}
