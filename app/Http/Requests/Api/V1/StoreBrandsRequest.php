<?php

namespace App\Http\Requests\Api\V1;

use App\DTO\StoreBrandsDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandsRequest extends FormRequest
{
    protected $stopOnFirstFailure = true ;
    public StoreBrandsDTO $storeBrandsDTO; 

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(){
        return $this->merge([
            'name'=>trim($this->name) , 
            'country'=>trim($this->country),
        ]);
    }

    public function rules(): array
    {
        return [
           'name'=>['string','required','unique:brand,name'] ,
           'description'=>['nullable','string'],
           'country'=>['required','string']
        ];
    }

    public function messages(){
        return [
            'name'=>[
                'string'=>'Name Filed Must Be String',
                'required'=> 'Name Field Is Required',
                'Unique'=> 'Name Brand Has been Taken',
            ],
            'description'=>[
                'string'=>'Description Must Be String',
            ],
            'country'=>[
                'required'=>'Country Is Required'
            ]
        ];
    }

    public function passedValidation(){
        return $this->storeBrandsDTO = new StoreBrandsDTO(
            name:$this->input('name') , 
            description:$this->input('description'),
            country:$this->input('country'),
        );
    }

    // public function failedValidation(Validator $validator){

    // }
}
