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
            'fk_id_branch' => 'required',
            'fk_id_branchDestination' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'stock.required'=> 'El stock es necesario',
            'stock.min'=> 'Debe ser mayor a cero la cantidad del ajuste',
            'comment.required'=> 'Debe ingresar un comentario del movimiento',
            'fk_id_branch' => 'No se puede enviar producto a la misma sucursal'
        ];
    }
}
