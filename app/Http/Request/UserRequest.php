<?php


namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:user'],
            'password' => 'required|confirmed',
            'fk_id_role' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre necesario',
            'email.required' => 'Correo electrónico necesario',
            'email.unique' => 'El correo ya está registrado',
            'email.email' => 'Ingrese un correo electrónico',
            'password.required' => 'Contraseña necesaria',
            'password.confirmed' => 'Las contraseñas deben coincidir',
            'fk_id_role.required' => 'Seleccione un perfil'
        ];
    }
}
