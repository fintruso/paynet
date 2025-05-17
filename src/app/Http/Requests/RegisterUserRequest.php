<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // todo mundo pode tentar registrar
    }

    public function rules(): array
    {
        return [
            'name'                  => 'required|string',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|confirmed|min:6',
            'cep'                   => 'required|digits:8',
            'numero'                => 'required|string',
        ];
    }
}
