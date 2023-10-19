<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //regras de validação de request
        $rules = [
            'first_name' => [
                'required',
                'min:3',
                'max:255'
            ],
            'last_name' =>  [
                'required',
                'min:3',
                'max:255'
            ],
            'document' =>  [
                'required',
                'min:3',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users'
            ],
            'phone_number' => [
                'nullable',
                'min:3',
                'max:255'
            ],
            'birth_date' => [
                'nullable',
                'date',
            ],
            'password' => [
                'required',
                'min:6',
                'max:100'
            ],
        ];

        //caso o metodo http seja PUT adiciona regras diferentes para email e password
        if($this->method() === 'PUT'){
           
            $rules['email'] =  [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ];
            $rules['password'] =  [
                'nullable',
                'min:6',
                'max:100'
            ];
        }
        return $rules;
    }
}
