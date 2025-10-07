<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatedFlavorsRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_id'=>['integer','required','exists:brand,id'],
            'name'=>['string','required' , Rule::unique('flavour','name')->ignore($this->flavor)],
            'components'=>['array','nullable'],
            'components.*'=>['integer','exists:component,id']
        ];
    }
}
