<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        return [

            // Duas formas de fazer validação de dados:
            // 1 - 'name' => 'required|string|min:3|max:255', - com "|" (Pipe)
            // 2 - 'name' => ['required', 'string', 'min:3', 'max:255'], - com "[]" (Array) *PREFERÍVEL*

            'name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'email',
                // 'unique:users,email', // unique:nome_tabela,nome_coluna: está dizendo que o email precisa ser unico na tabela users na coluna email.,
                Rule::unique('users', 'email')->ignore($this->user, 'id')
            ],
            'password' => [
                'required',
                'min:6',
                'max:20',
            ]
        ];
    }
}
