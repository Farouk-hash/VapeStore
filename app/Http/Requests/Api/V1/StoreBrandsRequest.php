<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
           'name'=>['string','required','unique:brand,name'] ,
           'description'=>['nullable','string'],
           'country'=>['required','string']
        ];
    }
}
