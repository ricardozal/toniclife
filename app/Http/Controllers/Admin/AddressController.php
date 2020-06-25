<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\AddressRequest;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Request\BranchRequest;
use App\Http\Controllers\Controller;


class AddressController extends Controller
{
    public function createPost(AddressRequest $request)
    {
        $address = new Address();
        $address->fill($request->all());


        if (!$address->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar la dirección'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);


    }
}
