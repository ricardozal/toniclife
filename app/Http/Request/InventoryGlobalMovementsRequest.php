<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class InventoryGlobalMovementsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stock' => 'required|min:1',
            'comment' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'stock.required'=> 'El stock es necesario',
            'stock.min'=> 'Debe ser mayor a cero la cantidad del ajuste',
            'comment.required'=> 'Debe ingresar un comentario del movimiento',
        ];
    }
}
