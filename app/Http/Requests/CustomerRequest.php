<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'cnpj' => 'required|cnpj',
        ];
    }

    /**
     * Return error messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Campo obrigatório',
            'name.string' => 'Nome muito pequeno',
            'name.min' => 'Nome muito pequeno',
            'cnpj.required' => 'Campo obrigatório',
            'cnpj.cnpj' => 'CNPJ inválido',
        ];
    }
}
