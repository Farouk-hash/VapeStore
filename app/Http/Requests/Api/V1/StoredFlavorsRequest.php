<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoredFlavorsRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'=>['string','required','unique:flavour,name'] , 
            'brand_id'=>['integer','required','exists:brand,id'],
            'components'=>['array','nullable'],
            'components.*'=>['integer','exists:component,id']
        ];
    }
}
