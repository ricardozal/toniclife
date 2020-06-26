<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDistributorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $distributorId = $this->route('distributorId');

        return [
            'tonic_life_id' => ['required', Rule::unique('distributor', 'tonic_life_id')->ignore($distributorId)],
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('distributor', 'email')->ignore($distributorId)],
        ];
    }

    public function messages()
    {
        return [
            'tonic_life_id.required' => 'Id Tonic Life necesario',
            'tonic_life_id.unique' => 'El ID Tonic Life ya está registrado',
            'name.required' => 'Nombre necesario',
            'email.required' => 'Correo electrónico necesario',
            'email.email' => 'Ingrese un correo electrónico',
            'email.unique' => 'El correo ya está registrado',
        ];
    }
}
