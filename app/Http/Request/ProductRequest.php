<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'file' => 'required',
            'distributor_price' => 'required',
            'points' => 'required',
            'fk_id_country' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Debe ingresar el código del producto',
            'name.required' => 'Debe ingresar el nombre del producto',
            'file.required' => 'Debe ingresar una imagen para el producto',
            'distributor_price.required' => 'Debe ingresar el precio de distribuidor',
            'points.required' => 'Debe ingresar los puntos del producto',
            'fk_id_country.required' => 'Debe elegir un catálogo'
        ];
    }
}
