<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class DistributorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tonic_life_id' => ['required', 'unique:distributor'],
            'name' => 'required',
            'email' => ['required', 'email', 'unique:distributor'],
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'tonic_life_id.required' => 'Id Tonic Life necesario',
            'tonic_life_id.unique' => 'El ID Tonic Life ya está registrado',
            'name.required' => 'Nombre necesario',
            'email.required' => 'Correo electrónico necesario',
            'email.unique' => 'El correo ya está registrado',
            'email.email' => 'Ingrese un correo electrónico',
            'password.required' => 'Contraseña necesaria',
            'password.confirmed' => 'Las contraseñas deben coincidir',
        ];
    }
}
