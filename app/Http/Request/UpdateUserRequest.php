<?php


namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $userId = $this->route('userId');

        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('user', 'email')->ignore($userId)],
            'password' => 'confirmed',
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
            'password.confirmed' => 'Las contraseñas deben coincidir',
            'fk_id_role.required' => 'Seleccione un perfil'
        ];
    }
}
