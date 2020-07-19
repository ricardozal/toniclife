<?php


namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;


class PromotionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'min_amount' => 'required',
            'begin_date' => 'required',
            'expiration_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre necesario',
            'description.required' => 'Descripción necesario',
            'min_amount.required' => 'Monto minímo necesario',
            'begin_date.required' => 'Ingrese una fecha de inicio',
            'expiration_date.required' => 'Ingrese una fecha de expiración'

        ];
    }
}
