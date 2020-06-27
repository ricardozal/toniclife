<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required',
            'name' => 'required',
            'distributor_price' => 'required',
            'points' => 'required',
            'fk_id_country' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'code' => 'Debe ingresar el código del producto',
            'name' => 'Debe ingresar el nombre del producto',
            'distributor_price' => 'Debe ingresar el precio de distribuidor',
            'points' => 'Debe ingresar los puntos del producto',
            'fk_id_country' => 'Debe elegir un catálogo'
        ];
    }
}
