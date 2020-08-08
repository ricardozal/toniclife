<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class InventoryLocalUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stock' => 'required|min:1',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'stock.required'=> 'El stock es necesario',
            'stock.min'=> 'Debe ser mayor a cero la cantidad del ajuste',
            'type.required'=> 'Se debe de seleccionar un tipo de movimiento',
        ];
    }
}
