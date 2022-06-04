<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerContactRequest extends FormRequest
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
            'cpf' => 'required|cpf',
            'email' => 'required|email'
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
            'cpf.required' => 'Campo obrigatório',
            'cpf.cpf' => 'CPF inválido',
            'email.required' => 'Campo obrigatório',
            'email.email' => 'Email inválido',
        ];
    }
}
