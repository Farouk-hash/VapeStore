<?php

namespace App\Http\Requests\Api\V1;

use App\DTO\RegisterUserDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRegisterRequest extends FormRequest
{
    protected $stopOnFirstFailure=true ; 
    public RegisterUserDTO $dto ; 
    
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(){
        return $this->merge([
            'name'=>trim($this->name),
            'email'=>strtolower(trim($this->email)),
        ]);
    }
   
    public function rules(): array
    {
        return [
            'name'=>['string','required','max:255'],
            'email'=>['email','required','unique:users,email'],
            'password'=>['string','required','confirmed'],
        ];
    }

    public function messages(){
        return [
            'name'=>[
                'string'=>'Name must be string',
                'required'=>'Name is required',
                'max'=>'Name max is 255',
            ],
            'email'=>[
                'email'=>'Invalid Mail',
                'unique'=>'Email already taken',
            ],
            'password'=>[
                'string'=>'Invalid Password',
                'required'=>'Password is required',
                'confirmed'=>'Password mismatch',
            ]
        ];
    }

    public function passedValidation(){
        return $this->dto = new RegisterUserDTO(
            name:$this->input('name'),
            email:$this->input('email'),
            password:$this->input('password'),
        );
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
            response()->json([
            'message'=>'Validation Failed',
            'error'=>env('APP_DEBUG') ? $validator->errors() : null ,
            'success'=>false ,
        ],422));
    }

}
