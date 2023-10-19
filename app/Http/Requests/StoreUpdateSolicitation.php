<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSolicitation extends FormRequest
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
            'description' => [
                'required',
                'min:3',
                'max:255'
            ],
            'quantity' =>  [
                'required',
                'min:1',
                'max:255'
            ],
            'price' =>  [
                'required',
                'min:1',
                'max:255'
            ],
        ];

        return $rules;
    }
}
