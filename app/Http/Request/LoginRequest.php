<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Ingrese su email de inicio de sesión.',
            'email.email' => 'Ingrese un email válido.',
            'password.required' => 'Ingrese su contraseña.'
        ];
    }
}
